<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ProductCategory::with('children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.product-categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new ProductCategory();

        $parents = ProductCategory::whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.product-categories.create', compact('category', 'parents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('categories', 'public');
        }

        ProductCategory::create($validated);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ProductCategory $productCategory): View
    {
        $category = $productCategory;

        $parents = ProductCategory::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.product-categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, ProductCategory $productCategory): RedirectResponse
    {
        $validated = $this->validateCategory($request);

        if ($productCategory->name !== $validated['name']) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $productCategory->id);
        }

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $this->deleteStoredFile($productCategory->image);
            $validated['image'] = $request->file('image_file')->store('categories', 'public');
        } else {
            $validated['image'] = $productCategory->image;
        }

        $productCategory->update($validated);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        if ($productCategory->children()->exists()) {
            return back()->with('error', 'Please delete child subcategories first.');
        }

        if ($productCategory->ranges()->exists() || $productCategory->subcategoryRanges()->exists()) {
            return back()->with('error', 'This category is used by products. Remove or reassign products first.');
        }

        $this->deleteStoredFile($productCategory->image);

        $productCategory->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'parent_id' => ['nullable', 'exists:product_categories,id'],
            'name' => ['required', 'string', 'max:190'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $count = 1;

        while (
            ProductCategory::where('slug', $slug)
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