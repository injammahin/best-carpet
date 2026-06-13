<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductColour;
use App\Models\ProductRange;
use App\Models\ProductRangePrice;
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

        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['gallery'] = [];
        $validated['features'] = $this->linesToArray($request->features);

        if ($request->hasFile('main_image_file')) {
            $validated['main_image'] = $request->file('main_image_file')->store('products/main', 'public');
        }

        $galleryImages = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                if ($image) {
                    $galleryImages[] = $image->store('products/gallery', 'public');
                }
            }
        }

        $validated['gallery'] = $galleryImages;

        $product = ProductRange::create($validated);

        $this->syncColours($product, $request);
        $this->syncPrices($product, $request);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Product range created successfully.');
    }

    public function edit(ProductRange $product): View
    {
        $product->load(['colours', 'prices']);

        return view('admin.products.edit', $this->formData($product));
    }

    public function update(Request $request, ProductRange $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);

        if ($product->name !== $validated['name']) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $product->id);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['features'] = $this->linesToArray($request->features);

        if ($request->hasFile('main_image_file')) {
            $this->deleteStoredFile($product->main_image);
            $validated['main_image'] = $request->file('main_image_file')->store('products/main', 'public');
        } else {
            $validated['main_image'] = $product->main_image;
        }

        $existingGallery = collect($request->input('existing_gallery', []))
            ->filter()
            ->values()
            ->all();

        $oldGallery = collect($product->gallery ?: [])->filter()->values();

        $oldGallery
            ->reject(fn ($oldImage) => in_array($oldImage, $existingGallery, true))
            ->each(fn ($oldImage) => $this->deleteStoredFile($oldImage));

        $galleryImages = $existingGallery;

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                if ($image) {
                    $galleryImages[] = $image->store('products/gallery', 'public');
                }
            }
        }

        $validated['gallery'] = array_values($galleryImages);

        $product->update($validated);

        $this->syncColours($product, $request);
        $this->syncPrices($product, $request);

        return back()->with('success', 'Product range updated successfully.');
    }

    public function destroy(ProductRange $product): RedirectResponse
    {
        $this->deleteStoredFile($product->main_image);

        foreach (($product->gallery ?: []) as $image) {
            $this->deleteStoredFile($image);
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
            'sizes' => ProductSizeOption::orderBy('sort_order')->orderBy('sqm')->get(),
            'priceMap' => $product->exists
                ? $product->prices->keyBy('product_size_option_id')
                : collect(),
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
            'existing_gallery' => ['nullable', 'array'],
            'existing_gallery.*' => ['nullable', 'string'],

            'features' => ['nullable', 'string'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'unit' => ['nullable', 'string', 'max:30'],

            'colour_group' => ['nullable', 'string', 'max:120'],
            'size_group' => ['nullable', 'string', 'max:120'],
            'room' => ['nullable', 'string', 'max:120'],

            'colour_names' => ['nullable', 'array'],
            'colour_names.*' => ['nullable', 'string', 'max:190'],
            'colour_swatches' => ['nullable', 'array'],
            'colour_swatches.*' => ['nullable', 'regex:/^#?[0-9A-Fa-f]{6}$/'],
            'colour_groups' => ['nullable', 'array'],
            'colour_groups.*' => ['nullable', 'string', 'max:120'],

            'prices' => ['nullable', 'array'],
            'prices.*' => ['nullable', 'numeric', 'min:0'],
            'regular_prices' => ['nullable', 'array'],
            'regular_prices.*' => ['nullable', 'numeric', 'min:0'],

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

        $colourNames = collect($request->input('colour_names', []))
            ->map(fn ($name) => trim((string) $name))
            ->filter();

        if ($colourNames->isEmpty()) {
            throw ValidationException::withMessages([
                'colour_names' => 'Please add at least one colour for this product range.',
            ]);
        }

        $hasAtLeastOnePrice = collect($request->input('prices', []))
            ->filter(fn ($price) => $price !== null && $price !== '')
            ->isNotEmpty();

        if (!$hasAtLeastOnePrice) {
            throw ValidationException::withMessages([
                'prices' => 'Please add at least one size price for this product range.',
            ]);
        }

        return $validated;
    }

private function syncColours(ProductRange $product, Request $request): void
{
    $names = $request->input('colour_names', []);
    $swatches = $request->input('colour_swatches', []);
    $groups = $request->input('colour_groups', []);

    $product->colours()->delete();

    foreach ($swatches as $index => $swatch) {
        $swatch = $this->normalizeHexColour($swatch);

        if (!$swatch) {
            continue;
        }

        $name = trim((string) ($names[$index] ?? ''));
        $group = trim((string) ($groups[$index] ?? ''));

        if ($name === '') {
            $name = $this->guessColourName($swatch);
        }

        if ($group === '') {
            $group = $this->guessColourGroup($swatch);
        }

        ProductColour::create([
            'product_range_id' => $product->id,
            'name' => $name,
            'swatch' => $swatch,
            'colour_group' => $group,
            'sort_order' => $index,
        ]);
    }
}

private function normalizeHexColour(?string $value): ?string
{
    $value = trim((string) $value);

    if ($value === '') {
        return null;
    }

    if (!str_starts_with($value, '#')) {
        $value = '#' . $value;
    }

    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $value)) {
        return null;
    }

    return strtoupper($value);
}

private function guessColourName(string $hex): string
{
    $group = $this->guessColourGroup($hex);

    return match ($group) {
        'Black' => 'Deep Black',
        'White' => 'Soft White',
        'Grey' => 'Soft Grey',
        'Brown' => 'Warm Brown',
        'Blue' => 'Classic Blue',
        'Green' => 'Natural Green',
        'Red' => 'Deep Red',
        'Orange' => 'Warm Orange',
        'Yellow' => 'Soft Yellow',
        'Purple' => 'Soft Purple',
        'Pink' => 'Soft Pink',
        default => 'Warm Neutral',
    };
}

private function guessColourGroup(string $hex): string
{
    $hex = ltrim($hex, '#');

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $delta = $max - $min;

    if ($max < 35) {
        return 'Black';
    }

    if ($min > 225) {
        return 'White';
    }

    if ($delta < 18) {
        return 'Grey';
    }

    if ($r > $g && $r > $b) {
        if ($g > 150 && $b < 90) {
            return 'Yellow';
        }

        if ($g > 90 && $b < 90) {
            return 'Orange';
        }

        if ($b > 120) {
            return 'Pink';
        }

        return 'Red';
    }

    if ($g > $r && $g > $b) {
        return 'Green';
    }

    if ($b > $r && $b > $g) {
        if ($r > 110) {
            return 'Purple';
        }

        return 'Blue';
    }

    if ($r > 100 && $g > 70 && $b < 80) {
        return 'Brown';
    }

    return 'Neutral';
}

    private function syncPrices(ProductRange $product, Request $request): void
    {
        $prices = $request->input('prices', []);
        $regularPrices = $request->input('regular_prices', []);

        $product->prices()->delete();

        foreach ($prices as $sizeId => $price) {
            if ($price === null || $price === '') {
                continue;
            }

            ProductRangePrice::create([
                'product_range_id' => $product->id,
                'product_size_option_id' => $sizeId,
                'price' => $price,
                'regular_price' => $regularPrices[$sizeId] ?? null,
            ]);
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