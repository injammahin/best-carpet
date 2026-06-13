@if($errors->any())
    <div class="mb-5 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
        <p class="font-semibold">Please fix the following errors:</p>
        <ul class="mt-2 list-inside list-disc">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 xl:grid-cols-[1fr_360px]">
    <div class="clean-card bg-white p-6">
        <p class="section-label mb-2">Review details</p>
        <h2 class="text-2xl text-mega-black">Customer Review</h2>

        <div class="mt-6 grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Customer Name *</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $review->customer_name) }}"
                    class="input-clean" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Customer Title</label>
                <input type="text" name="customer_title" value="{{ old('customer_title', $review->customer_title) }}"
                    class="input-clean" placeholder="Homeowner, Builder, Business owner">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Location</label>
                <input type="text" name="location" value="{{ old('location', $review->location) }}" class="input-clean">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Rating *</label>
                <select name="rating" class="input-clean" required>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $review->rating ?: 5) == $i)>
                            {{ $i }} Star
                        </option>
                    @endfor
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-mega-text">Related Product</label>
                <select name="product_range_id" class="input-clean">
                    <option value="">No product selected</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected(old('product_range_id', $review->product_range_id) == $product->id)>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-mega-text">Review Text *</label>
                <textarea name="review_text" rows="8" class="input-clean"
                    required>{{ old('review_text', $review->review_text) }}</textarea>
            </div>
        </div>
    </div>

    <aside class="space-y-6">
        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Customer Photo</p>

            @if($review->exists && $review->imageUrl())
                <div class="mb-3 overflow-hidden rounded-[14px] border border-mega-line bg-mega-soft">
                    <img src="{{ $review->imageUrl() }}" alt="{{ $review->customer_name }}"
                        class="h-48 w-full object-cover">
                </div>
            @endif

            <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp"
                class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm">
            <p class="mt-1 text-xs text-mega-muted">Optional. JPG, PNG or WebP. Max 4MB.</p>
        </div>

        <div class="clean-card bg-white p-6">
            <label class="flex items-center gap-2 text-sm font-semibold text-mega-text">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $review->exists ? $review->is_featured : true))>
                Show on homepage slider
            </label>

            <label class="mt-4 flex items-center gap-2 text-sm font-semibold text-mega-text">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $review->exists ? $review->is_active : true))>
                Active
            </label>

            <label class="mb-2 mt-5 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $review->sort_order ?: 0) }}"
                class="input-clean">

            <button type="submit" class="btn-primary mt-6 w-full justify-center">Save Review</button>
            <a href="{{ route('admin.reviews.index') }}" class="btn-light mt-3 w-full justify-center">Cancel</a>
        </div>
    </aside>
</div>