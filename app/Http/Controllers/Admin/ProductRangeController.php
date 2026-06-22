<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductGalleryImage;
use App\Models\ProductRange;
use App\Models\ProductSizeOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductRangeController extends Controller
{
    public function index(Request $request): View
    {
        $query = ProductRange::with(['category', 'subcategory'])
            ->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(15)->withQueryString();

        $categories = ProductCategory::whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $product = new ProductRange();

        return view('admin.products.create', $this->formData($product));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $category = ProductCategory::findOrFail($validated['category_id']);
        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['features'] = $this->linesToArray($request->features);
        $validated['gallery'] = [];
        $validated['price_mode'] = $category->slug === 'rugs' ? 'fixed' : 'per_sqm';
        $validated['selected_size_option_ids'] = $category->slug === 'rugs'
            ? []
            : array_values($request->input('selected_size_option_ids', []));

        if ($request->hasFile('main_image_file')) {
            $validated['main_image'] = $request->file('main_image_file')->store('products/main', 'public');
        }

        $product = ProductRange::create($validated);

        $this->syncGalleryImages($product, $request);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Product range created successfully.');
    }

    public function edit(ProductRange $product): View
    {
        $product->load(['category', 'subcategory', 'galleryImages']);

        return view('admin.products.edit', $this->formData($product));
    }

    public function update(Request $request, ProductRange $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);

        $category = ProductCategory::findOrFail($validated['category_id']);

        if ($product->name !== $validated['name']) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $product->id);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['features'] = $this->linesToArray($request->features);
        $validated['price_mode'] = $category->slug === 'rugs' ? 'fixed' : 'per_sqm';
        $validated['selected_size_option_ids'] = $category->slug === 'rugs'
            ? []
            : array_values($request->input('selected_size_option_ids', []));

        if ($request->hasFile('main_image_file')) {
            $this->deleteStoredFile($product->main_image);
            $validated['main_image'] = $request->file('main_image_file')->store('products/main', 'public');
        } else {
            $validated['main_image'] = $product->main_image;
        }

        $product->update($validated);

        $this->syncGalleryImages($product, $request);

        return back()->with('success', 'Product range updated successfully.');
    }

    public function destroy(ProductRange $product): RedirectResponse
    {
        $product->load('galleryImages');

        $this->deleteStoredFile($product->main_image);

        foreach ($product->galleryImages as $galleryImage) {
            $this->deleteStoredFile($galleryImage->image);
            $galleryImage->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product range deleted successfully.');
    }

    private function formData(ProductRange $product): array
    {
        return [
            'product' => $product,
            'categories' => ProductCategory::whereNull('parent_id')
                ->with('children')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'sizes' => ProductSizeOption::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('sqm')
                ->get(),
            'selectedSizeIds' => collect(old('selected_size_option_ids', $product->selected_size_option_ids ?: []))
                ->map(fn ($id) => (int) $id)
                ->values()
                ->all(),
        ];
    }

    private function validateProduct(Request $request, ?ProductRange $product = null): array
    {
        $mainImageRule = $product && $product->exists
            ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096']
            : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];

        $validated = $request->validate([
            'category_id' => ['required', 'exists:product_categories,id'],
            'subcategory_id' => ['nullable', 'exists:product_categories,id'],

            'name' => ['required', 'string', 'max:190'],
            'badge' => ['nullable', 'string', 'max:120'],
            'short_description' => ['required', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],

            'main_image_file' => $mainImageRule,

            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery_colour_names' => ['nullable', 'array'],
            'gallery_colour_names.*' => ['nullable', 'string', 'max:190'],

            'existing_gallery_ids' => ['nullable', 'array'],
            'existing_gallery_ids.*' => ['nullable', 'integer', 'exists:product_gallery_images,id'],
            'existing_gallery_colour_names' => ['nullable', 'array'],
            'existing_gallery_colour_names.*' => ['nullable', 'string', 'max:190'],

            'features' => ['nullable', 'string'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'unit' => ['nullable', 'string', 'max:30'],

            'base_price' => ['required', 'numeric', 'min:0'],

            'selected_size_option_ids' => ['nullable', 'array'],
            'selected_size_option_ids.*' => ['nullable', 'integer', 'exists:product_size_options,id'],

            'size_group' => ['nullable', 'string', 'max:120'],
            'room' => ['nullable', 'string', 'max:120'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (!empty($validated['subcategory_id'])) {
            $subcategory = ProductCategory::find($validated['subcategory_id']);

            if (!$subcategory || (int) $subcategory->parent_id !== (int) $validated['category_id']) {
                throw ValidationException::withMessages([
                    'subcategory_id' => 'The selected subcategory must belong to the selected category.',
                ]);
            }
        }

        $category = ProductCategory::find($validated['category_id']);
        $isRug = $category && $category->slug === 'rugs';

        if (!$isRug && !count($request->input('selected_size_option_ids', []))) {
            throw ValidationException::withMessages([
                'selected_size_option_ids' => 'Please select at least one size for this product.',
            ]);
        }

        return $validated;
    }

    private function syncGalleryImages(ProductRange $product, Request $request): void
    {
        $product->load('galleryImages');

        $keptIds = collect($request->input('existing_gallery_ids', []))
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values();

        foreach ($product->galleryImages as $galleryImage) {
            if (!$keptIds->contains($galleryImage->id)) {
                $this->deleteStoredFile($galleryImage->image);
                $galleryImage->delete();
            }
        }

        foreach ($keptIds as $sortOrder => $galleryId) {
            $galleryImage = ProductGalleryImage::where('product_range_id', $product->id)
                ->where('id', $galleryId)
                ->first();

            if (!$galleryImage) {
                continue;
            }

            $galleryImage->update([
                'colour_name' => $request->input("existing_gallery_colour_names.$galleryId"),
                'sort_order' => $sortOrder,
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            $colourNames = $request->input('gallery_colour_names', []);
            $startSort = $product->galleryImages()->count();

            foreach ($request->file('gallery_images') as $index => $image) {
                if (!$image) {
                    continue;
                }

                ProductGalleryImage::create([
                    'product_range_id' => $product->id,
                    'image' => $image->store('products/gallery', 'public'),
                    'colour_name' => $colourNames[$index] ?? null,
                    'sort_order' => $startSort + $index,
                ]);
            }
        }
    }

    private function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value ?: ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $count = 1;

        while (
            ProductRange::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private function deleteStoredFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/storage/', 'storage/'])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}