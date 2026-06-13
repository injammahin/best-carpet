<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\ProductRange;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = CustomerReview::with('productRange')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create(): View
    {
        $review = new CustomerReview();
        $products = ProductRange::orderBy('name')->get();

        return view('admin.reviews.create', compact('review', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateReview($request);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('reviews', 'public');
        }

        CustomerReview::create($validated);

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function edit(CustomerReview $review): View
    {
        $products = ProductRange::orderBy('name')->get();

        return view('admin.reviews.edit', compact('review', 'products'));
    }

    public function update(Request $request, CustomerReview $review): RedirectResponse
    {
        $validated = $this->validateReview($request);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image_file')) {
            $this->deleteStoredFile($review->image);
            $validated['image'] = $request->file('image_file')->store('reviews', 'public');
        } else {
            $validated['image'] = $review->image;
        }

        $review->update($validated);

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(CustomerReview $review): RedirectResponse
    {
        $this->deleteStoredFile($review->image);

        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }

    private function validateReview(Request $request): array
    {
        return $request->validate([
            'product_range_id' => ['nullable', 'exists:product_ranges,id'],
            'customer_name' => ['required', 'string', 'max:190'],
            'customer_title' => ['nullable', 'string', 'max:190'],
            'location' => ['nullable', 'string', 'max:190'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string', 'max:5000'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
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