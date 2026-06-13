<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\Faq;
use App\Models\ProductCategory;
use App\Models\ProductRange;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $categories = ProductCategory::active()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(4)
            ->get()
            ->map(fn ($category) => [
                'name' => $category->name,
                'slug' => $category->slug,
                'text' => $category->short_description ?: 'Premium flooring range for modern homes and commercial spaces.',
                'image' => $category->image_url ?: 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80',
            ])
            ->values()
            ->all();

        $products = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'colours',
                'prices.sizeOption',
            ])
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->take(8)
            ->get()
            ->map(fn ($product) => $this->homeProductCard($product))
            ->values()
            ->all();

        $reviews = CustomerReview::active()
            ->featured()
            ->with('productRange')
            ->orderBy('sort_order')
            ->latest()
            ->take(12)
            ->get();

        $faqs = Faq::active()
            ->orderBy('sort_order')
            ->orderBy('question')
            ->get();

        return view('frontend.home', [
            'categories' => $categories,
            'products' => $products,
            'reviews' => $reviews,
            'faqs' => $faqs,
        ]);
    }

    private function homeProductCard(ProductRange $product): array
    {
        $product->loadMissing([
            'category',
            'subcategory',
            'colours',
            'prices.sizeOption',
        ]);

        $prices = $product->prices
            ->filter(fn ($price) => $price->sizeOption && $price->sizeOption->is_active)
            ->sortBy(fn ($price) => $price->sizeOption->sort_order)
            ->values();

        $types = $prices
            ->map(fn ($price) => [
                'label' => $price->sizeOption->label,
                'price' => (float) $price->price,
            ])
            ->values()
            ->all();

        if (!count($types)) {
            $types = [
                [
                    'label' => 'Quote required',
                    'price' => 0,
                ],
            ];
        }

        $variants = $product->colours
            ->map(fn ($colour) => [
                'name' => $colour->name,
                'swatch' => $colour->swatch ?: '#d8c7b5',
                'types' => $types,
            ])
            ->values()
            ->all();

        if (!count($variants)) {
            $variants = [
                [
                    'name' => 'Standard colour',
                    'swatch' => '#d8c7b5',
                    'types' => $types,
                ],
            ];
        }

        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'category' => $product->category?->name ?: 'Flooring',
            'category_slug' => $product->category?->slug ?: 'products',
            'room' => $product->room ?: 'Home',
            'tag' => $product->badge ?: ($product->subcategory?->name ?: 'Featured range'),
            'rating' => number_format((float) ($product->rating ?: 4.8), 1),
            'image' => $product->imageUrl(),
            'variants' => $variants,
        ];
    }

    public function aboutUs(): View
    {
        return view('frontend.about-us');
    }

    public function products(Request $request): View
    {
        $activeCategory = null;

        if ($request->filled('category')) {
            $activeCategory = ProductCategory::active()
                ->where('slug', $request->query('category'))
                ->first();
        }

        return $this->renderProductListing($request, $activeCategory);
    }

    public function productShow(Request $request, string $slug): View
    {
        $category = ProductCategory::active()
            ->where('slug', $slug)
            ->first();

        if ($category) {
            return $this->renderProductListing($request, $category);
        }

        $product = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'colours',
                'prices.sizeOption',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $productArray = $product->toFrontendArray();

        $relatedProducts = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'colours',
                'prices.sizeOption',
            ])
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->when($product->subcategory_id, function ($query) use ($product) {
                $query->orderByRaw(
                    'CASE WHEN subcategory_id = ? THEN 0 ELSE 1 END',
                    [$product->subcategory_id]
                );
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(4)
            ->get()
            ->map(fn ($range) => $range->toFrontendArray())
            ->values()
            ->all();

        return view('frontend.products.show', [
            'product' => $productArray,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    private function renderProductListing(Request $request, ?ProductCategory $activeCategory = null): View
    {
        $categories = ProductCategory::active()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $activeCategorySlug = $activeCategory?->slug;

        $activeCategoryArray = $activeCategory
            ? [
                'name' => $activeCategory->name,
                'slug' => $activeCategory->slug,
                'short' => $activeCategory->short_description,
            ]
            : null;

        $typeFilters = $this->normalizeTypeFilters(
            $this->arrayInput($request->input('type', []))
        );

        $activeFilters = [
            'colour_group' => $this->arrayInput($request->input('colour_group', [])),
            'size_group' => $this->arrayInput($request->input('size_group', [])),
            'type' => $typeFilters,
            'room' => $this->arrayInput($request->input('room', [])),
        ];

        $query = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'colours',
                'prices.sizeOption',
            ])
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($activeCategory) {
            if ($activeCategory->parent_id) {
                $query->where('subcategory_id', $activeCategory->id);
            } else {
                $query->where('category_id', $activeCategory->id);
            }
        }

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('room', 'like', "%{$search}%")
                    ->orWhere('colour_group', 'like', "%{$search}%")
                    ->orWhere('size_group', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('slug', 'like', "%{$search}%");
                    })
                    ->orWhereHas('subcategory', function ($subcategoryQuery) use ($search) {
                        $subcategoryQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('slug', 'like', "%{$search}%");
                    })
                    ->orWhereHas('colours', function ($colourQuery) use ($search) {
                        $colourQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('colour_group', 'like', "%{$search}%");
                    });
            });
        }

        if (count($activeFilters['colour_group'])) {
            $query->where(function ($subQuery) use ($activeFilters) {
                $subQuery
                    ->whereIn('colour_group', $activeFilters['colour_group'])
                    ->orWhereHas('colours', function ($colourQuery) use ($activeFilters) {
                        $colourQuery->whereIn('colour_group', $activeFilters['colour_group']);
                    });
            });
        }

        if (count($activeFilters['size_group'])) {
            $query->whereHas('prices.sizeOption', function ($sizeQuery) use ($activeFilters) {
                $sizeQuery->whereIn('size_group', $activeFilters['size_group']);
            });
        }

        if (count($activeFilters['type'])) {
            $query->whereHas('subcategory', function ($subcategoryQuery) use ($activeFilters) {
                $subcategoryQuery
                    ->whereIn('name', $activeFilters['type'])
                    ->orWhereIn('slug', $activeFilters['type']);
            });
        }

        if (count($activeFilters['room'])) {
            $query->whereIn('room', $activeFilters['room']);
        }

        $ranges = $query->get();

        $products = $ranges
            ->map(fn ($range) => $range->toFrontendArray())
            ->values()
            ->all();

        $filterBaseQuery = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'colours',
                'prices.sizeOption',
            ]);

        if ($activeCategory) {
            if ($activeCategory->parent_id) {
                $filterBaseQuery->where('subcategory_id', $activeCategory->id);
            } else {
                $filterBaseQuery->where('category_id', $activeCategory->id);
            }
        }

        $filterRanges = $filterBaseQuery->get();

        $filterOptions = [
            'colour_group' => $this->countOptions(
                $filterRanges->flatMap(function ($range) {
                    return collect([$range->colour_group])
                        ->merge($range->colours->pluck('colour_group'))
                        ->filter();
                })
            ),

            'size_group' => $this->countOptions(
                $filterRanges->flatMap(function ($range) {
                    return $range->prices
                        ->map(fn ($price) => $price->sizeOption?->size_group)
                        ->filter();
                })
            ),

            'type' => $this->countOptions(
                $filterRanges
                    ->map(fn ($range) => $range->subcategory?->name)
                    ->filter()
            ),

            'room' => $this->countOptions(
                $filterRanges
                    ->pluck('room')
                    ->filter()
            ),
        ];

        return view('frontend.products.index', [
            'products' => $products,

            'categories' => $categories
                ->map(fn ($category) => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                ])
                ->values()
                ->all(),

            'activeCategory' => $activeCategoryArray,
            'activeCategorySlug' => $activeCategorySlug,
            'search' => trim((string) $request->query('q', '')),
            'filterOptions' => $filterOptions,
            'activeFilters' => $activeFilters,
        ]);
    }

    private function arrayInput(mixed $value): array
    {
        if (is_null($value)) {
            return [];
        }

        if (!is_array($value)) {
            $value = [$value];
        }

        return collect($value)
            ->map(fn ($item) => trim((string) $item))
            ->filter(fn ($item) => $item !== '')
            ->unique()
            ->values()
            ->all();
    }

    private function normalizeTypeFilters(array $values): array
    {
        if (!count($values)) {
            return [];
        }

        $subcategories = ProductCategory::active()
            ->whereNotNull('parent_id')
            ->where(function ($query) use ($values) {
                $query
                    ->whereIn('slug', $values)
                    ->orWhereIn('name', $values);
            })
            ->get();

        return collect($values)
            ->map(function ($value) use ($subcategories) {
                $match = $subcategories->first(function ($subcategory) use ($value) {
                    return $subcategory->slug === $value || $subcategory->name === $value;
                });

                return $match ? $match->name : $value;
            })
            ->unique()
            ->values()
            ->all();
    }

    private function countOptions($items): array
    {
        return collect($items)
            ->filter(fn ($item) => filled($item))
            ->countBy()
            ->sortKeys()
            ->map(fn ($count, $label) => [
                'label' => $label,
                'count' => $count,
            ])
            ->values()
            ->all();
    }

    public function mobileShowroom(): View
    {
        return view('frontend.mobile-showroom');
    }

    public function quote(): View
    {
        return view('frontend.quote');
    }

    public function inspiration(): View
    {
        return view('frontend.inspiration.index');
    }

    public function contact(): View
    {
        return view('frontend.contact');
    }
}