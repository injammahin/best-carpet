<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSizeOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductSizeOptionController extends Controller
{
    public function index(): View
    {
        $sizes = ProductSizeOption::orderBy('sort_order')->orderBy('sqm')->get();

        return view('admin.product-sizes.index', compact('sizes'));
    }

    public function create(): View
    {
        $size = new ProductSizeOption();

        return view('admin.product-sizes.create', compact('size'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSize($request);
        $validated['is_active'] = $request->boolean('is_active');

        ProductSizeOption::create($validated);

        return redirect()
            ->route('admin.product-sizes.index')
            ->with('success', 'Size option created successfully.');
    }

    public function edit(ProductSizeOption $productSize): View
    {
        $size = $productSize;

        return view('admin.product-sizes.edit', compact('size'));
    }

    public function update(Request $request, ProductSizeOption $productSize): RedirectResponse
    {
        $validated = $this->validateSize($request);
        $validated['is_active'] = $request->boolean('is_active');

        $productSize->update($validated);

        return redirect()
            ->route('admin.product-sizes.index')
            ->with('success', 'Size option updated successfully.');
    }

    public function destroy(ProductSizeOption $productSize): RedirectResponse
    {
        if ($productSize->prices()->exists()) {
            return back()->with('error', 'This size is used in product pricing. Remove product prices first.');
        }

        $productSize->delete();

        return back()->with('success', 'Size option deleted successfully.');
    }

    private function validateSize(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:190'],
            'sqm' => ['required', 'numeric', 'min:0.01'],
            'size_group' => ['required', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}