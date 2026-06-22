<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\Faq;
use App\Models\HomePageSetting;
use App\Models\ProductCategory;
use App\Models\ProductRange;
use App\Models\ProductSizeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $mainCategorySlugs = [
            'carpet',
            'timber',
            'hybrid-flooring',
            'laminate',
            'vinyl',
            'rugs',
        ];

        $homeSetting = HomePageSetting::query()->firstOrCreate([], HomePageSetting::defaultData());

        $categoryModels = ProductCategory::active()
            ->whereNull('parent_id')
            ->whereIn('slug', $mainCategorySlugs)
            ->orderByRaw("FIELD(slug, 'carpet', 'timber', 'hybrid-flooring', 'laminate', 'vinyl', 'rugs')")
            ->get();

        $categories = $categoryModels
            ->map(fn ($category) => [
                'name' => $category->name,
                'slug' => $category->slug,
                'text' => $category->short_description ?: 'Premium flooring range for modern homes and commercial spaces.',
                'image' => $category->image_url ?: 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80',
            ])
            ->values()
            ->all();

        $homeFilterCategories = $categoryModels
            ->map(fn ($category) => [
                'name' => $category->name,
                'slug' => $category->slug,
            ])
            ->values()
            ->all();

        $defaultHomeCategorySlug = $homeFilterCategories[0]['slug'] ?? null;
        $defaultHomeCategoryName = $homeFilterCategories[0]['name'] ?? 'Products';

        $categoryProductGroups = [];

        foreach ($categoryModels as $category) {
            $categoryProductGroups[$category->slug] = ProductRange::active()
                ->with([
                    'category',
                    'subcategory',
                    'galleryImages',
                ])
                ->where('category_id', $category->id)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->take(8)
                ->get()
                ->map(fn ($product) => $this->homeProductCard($product))
                ->values()
                ->all();
        }

        $products = $defaultHomeCategorySlug
            ? ($categoryProductGroups[$defaultHomeCategorySlug] ?? [])
            : [];

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
            'homeSetting' => $homeSetting,
            'categories' => $categories,
            'products' => $products,
            'homeFilterCategories' => $homeFilterCategories,
            'categoryProductGroups' => $categoryProductGroups,
            'defaultHomeCategorySlug' => $defaultHomeCategorySlug,
            'defaultHomeCategoryName' => $defaultHomeCategoryName,
            'reviews' => $reviews,
            'faqs' => $faqs,
        ]);
    }

    private function homeProductCard(ProductRange $product): array
    {
        $mapped = $this->mapProductForFrontend($product);

        $isRug = $mapped['is_rug'];

        $typeOptions = $isRug
            ? [
                [
                    'label' => 'Fixed rug price',
                    'price' => $mapped['fixed_price'],
                    'sqm' => '',
                ],
            ]
            : collect($mapped['sizes'])
                ->map(fn ($size) => [
                    'label' => $size['label'],
                    'price' => $size['price'],
                    'sqm' => $size['sqm'],
                ])
                ->values()
                ->all();

        if (!count($typeOptions)) {
            $typeOptions = [
                [
                    'label' => 'Quote required',
                    'price' => 0,
                    'sqm' => '',
                ],
            ];
        }

        $mapped['tag'] = $mapped['badge'] ?: ($mapped['type'] ?: 'Featured range');
        $mapped['rating'] = number_format((float) ($mapped['rating'] ?: 0), 1);
        $mapped['variants'] = [
            [
                'name' => $isRug ? 'Rug price' : 'Area size',
                'swatch' => '#d8c7b5',
                'types' => $typeOptions,
            ],
        ];

        return $mapped;
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
                'galleryImages',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $productArray = $this->mapProductForFrontend($product);

        $relatedProducts = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'galleryImages',
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
            ->map(fn ($range) => $this->mapProductForFrontend($range))
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
            'size_group' => $this->arrayInput($request->input('size_group', [])),
            'type' => $typeFilters,
            'room' => $this->arrayInput($request->input('room', [])),
        ];

        $query = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'galleryImages',
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
                    ->orWhereHas('galleryImages', function ($galleryQuery) use ($search) {
                        $galleryQuery->where('colour_name', 'like', "%{$search}%");
                    });
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

        if (count($activeFilters['size_group'])) {
            $ranges = $ranges
                ->filter(function ($range) use ($activeFilters) {
                    return collect($this->sizeGroupsForRange($range))
                        ->intersect($activeFilters['size_group'])
                        ->isNotEmpty();
                })
                ->values();
        }

        $products = $ranges
            ->map(fn ($range) => $this->mapProductForFrontend($range))
            ->values()
            ->all();

        $filterBaseQuery = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'galleryImages',
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
            'size_group' => $this->countOptions(
                $filterRanges->flatMap(fn ($range) => $this->sizeGroupsForRange($range))
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

    private function mapProductForFrontend(ProductRange $product): array
    {
        $product->loadMissing([
            'category',
            'subcategory',
            'galleryImages',
        ]);

        $isRug = $this->isRugProduct($product);
        $basePrice = (float) ($product->base_price ?? 0);

        $gallery = $this->galleryForProduct($product);
        $sizes = $isRug ? [] : $this->sizesForProduct($product, $basePrice);

        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'category' => $product->category?->name ?: 'Product',
            'category_slug' => $product->category?->slug ?: '',
            'subcategory' => $product->subcategory?->name,
            'type' => $product->subcategory?->name ?: $product->category?->name,
            'room' => $product->room ?: 'Room',
            'style' => $product->badge ?: '',
            'badge' => $product->badge ?: 'Popular',
            'tag' => $product->badge ?: 'Popular',
            'short' => $product->short_description,
            'description' => $product->description,
            'image' => $product->imageUrl(),
            'gallery' => $gallery,
            'is_rug' => $isRug,
            'price_mode' => $isRug ? 'fixed' : 'per_sqm',
            'price_from' => $basePrice,
            'fixed_price' => $isRug ? $basePrice : null,
            'price_per_sqm' => $isRug ? null : $basePrice,
            'unit' => $isRug ? 'item' : 'm²',
            'sizes' => $sizes,
            'size_groups' => collect($sizes)->pluck('label')->values()->all(),
            'rating' => (float) ($product->rating ?: 0),
            'features' => $product->features ?: [],
            'variants' => [
                [
                    'label' => $isRug ? 'Fixed price' : 'Area size',
                    'types' => $isRug
                        ? [
                            [
                                'label' => 'Fixed rug price',
                                'price' => $basePrice,
                                'sqm' => '',
                            ],
                        ]
                        : collect($sizes)->map(fn ($size) => [
                            'label' => $size['label'],
                            'price' => $size['price'],
                            'sqm' => $size['sqm'],
                        ])->values()->all(),
                ],
            ],
        ];
    }

    private function galleryForProduct(ProductRange $product): array
    {
        $gallery = collect();

        if ($product->main_image) {
            $gallery->push([
                'image' => $product->imageUrl(),
                'colour_name' => 'Main image',
            ]);
        }

        foreach ($product->galleryImages as $galleryImage) {
            $gallery->push([
                'image' => $galleryImage->imageUrl(),
                'colour_name' => $galleryImage->colour_name ?: 'Gallery image',
            ]);
        }

        if (!$gallery->count()) {
            $gallery->push([
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=85',
                'colour_name' => 'Gallery image',
            ]);
        }

        return $gallery->values()->all();
    }

    private function sizesForProduct(ProductRange $product, float $basePrice): array
    {
        $sizeIds = $this->normalArray($product->selected_size_option_ids);

        if (!count($sizeIds)) {
            return [];
        }

        return ProductSizeOption::query()
            ->whereIn('id', $sizeIds)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('sqm')
            ->get()
            ->map(function ($size) use ($basePrice) {
                $sqm = (float) $size->sqm;

                return [
                    'id' => $size->id,
                    'label' => $size->label,
                    'sqm' => $sqm,
                    'size_group' => $size->size_group,
                    'price' => round($basePrice * $sqm, 2),
                    'price_per_sqm' => $basePrice,
                ];
            })
            ->values()
            ->all();
    }

    private function sizeGroupsForRange(ProductRange $product): array
    {
        if ($this->isRugProduct($product)) {
            return [];
        }

        $sizeIds = $this->normalArray($product->selected_size_option_ids);

        if (!count($sizeIds)) {
            return [];
        }

        return ProductSizeOption::query()
            ->whereIn('id', $sizeIds)
            ->where('is_active', true)
            ->pluck('size_group')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function isRugProduct(ProductRange $product): bool
    {
        return $product->price_mode === 'fixed'
            || $product->category?->slug === 'rugs'
            || $product->subcategory?->slug === 'rugs';
    }

    private function normalArray(mixed $value): array
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $value = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($value)) {
            return [];
        }

        return collect($value)
            ->filter(fn ($item) => $item !== null && $item !== '')
            ->map(fn ($item) => (int) $item)
            ->unique()
            ->values()
            ->all();
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

    public function searchSuggestions(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $categorySlug = trim((string) $request->query('category', ''));

        if (mb_strlen($search) < 2) {
            return response()->json([
                'query' => $search,
                'all_results_url' => route('frontend.products', array_filter([
                    'q' => $search,
                    'category' => $categorySlug,
                ])),
                'suggestions' => [],
            ]);
        }

        $selectedCategory = null;

        if ($categorySlug !== '') {
            $selectedCategory = ProductCategory::active()
                ->where('slug', $categorySlug)
                ->first();
        }

        $products = ProductRange::active()
            ->with([
                'category',
                'subcategory',
                'galleryImages',
            ])
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                if ($selectedCategory->parent_id) {
                    $query->where('subcategory_id', $selectedCategory->id);
                } else {
                    $query->where('category_id', $selectedCategory->id);
                }
            })
            ->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('room', 'like', "%{$search}%")
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
                    ->orWhereHas('galleryImages', function ($galleryQuery) use ($search) {
                        $galleryQuery->where('colour_name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(6)
            ->get()
            ->map(function ($product) {
                return [
                    'type' => 'product',
                    'badge' => 'Product',
                    'title' => $product->name,
                    'subtitle' => collect([
                        $product->category?->name,
                        $product->subcategory?->name,
                        $product->room,
                    ])->filter()->join(' · '),
                    'image' => $product->imageUrl(),
                    'url' => route('frontend.product.show', $product->slug),
                ];
            });

        $categories = ProductCategory::active()
            ->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            })
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(4)
            ->get()
            ->map(function ($category) {
                return [
                    'type' => 'category',
                    'badge' => $category->parent_id ? 'Type' : 'Category',
                    'title' => $category->name,
                    'subtitle' => Str::limit($category->short_description ?: 'Browse matching flooring products.', 80),
                    'image' => $category->image_url ?: null,
                    'url' => route('frontend.product.show', $category->slug),
                ];
            });

        return response()->json([
            'query' => $search,
            'all_results_url' => route('frontend.products', array_filter([
                'q' => $search,
                'category' => $categorySlug,
            ])),
            'suggestions' => $products
                ->merge($categories)
                ->values()
                ->all(),
        ]);
    }
}