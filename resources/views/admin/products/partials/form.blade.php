@if(session('success'))
    <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
        {{ session('success') }}
    </div>
@endif

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

@php
    $selectedSizeIds = collect($selectedSizeIds ?? old('selected_size_option_ids', $product->selected_size_option_ids ?: []))
        ->map(fn($id) => (int) $id)
        ->values()
        ->all();

    $selectedCategoryId = old('category_id', $product->category_id);
    $selectedCategory = $categories->firstWhere('id', (int) $selectedCategoryId);
    $isRugSelected = $selectedCategory && $selectedCategory->slug === 'rugs';
@endphp

<div class="grid gap-6 xl:grid-cols-[1fr_380px]">
    <div class="space-y-6">
        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Product range</p>
            <h2 class="text-2xl text-mega-black">Basic Details</h2>

            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Category *</label>
                    <select name="category_id" id="productCategorySelect" class="input-clean" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                data-slug="{{ $category->slug }}"
                                @selected(old('category_id', $product->category_id) == $category->id)
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Subcategory</label>
                    <select name="subcategory_id" class="input-clean">
                        <option value="">No subcategory</option>
                        @foreach($categories as $category)
                            @if($category->children->count())
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" @selected(old('subcategory_id', $product->subcategory_id) == $child->id)>
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-mega-muted">Use this for carpet types like Nylon Carpet or Wool Carpet.</p>
                    @error('subcategory_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Range Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-clean" required>
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Badge</label>
                    <input type="text" name="badge" value="{{ old('badge', $product->badge ?: 'Popular') }}" class="input-clean">
                    @error('badge') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', $product->unit ?: 'm²') }}" class="input-clean">
                    @error('unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Room</label>
                    <input type="text" name="room" value="{{ old('room', $product->room) }}" class="input-clean" placeholder="Bedroom, Lounge, Kitchen">
                    @error('room') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-mega-text">Short Description *</label>
                    <textarea name="short_description" rows="3" class="input-clean" required>{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-mega-text">Full Description</label>
                    <textarea name="description" rows="5" class="input-clean">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Pricing</p>
            <h2 class="text-2xl text-mega-black">Single Product Price</h2>

            <p class="mt-2 text-sm text-mega-muted">
                For flooring products, enter the price for 1m² and select the available sizes. The frontend will calculate the total automatically.
                For rugs, enter one fixed rug price and no size selection is needed.
            </p>

            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">
                        <span data-price-label>{{ $isRugSelected ? 'Fixed Rug Price *' : 'Price for 1m² *' }}</span>
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="base_price"
                        value="{{ old('base_price', $product->base_price) }}"
                        class="input-clean"
                        placeholder="{{ $isRugSelected ? 'e.g. 299' : 'e.g. 47' }}"
                        required
                    >

                    @error('base_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6" data-size-selection-wrap>
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-semibold text-mega-black">Available Sizes</h3>
                        <p class="mt-1 text-sm text-mega-muted">
                            Select the sizes customers can choose. Price will be calculated from your 1m² price.
                        </p>
                    </div>
                </div>

                @error('selected_size_option_ids') <p class="mb-3 text-sm text-red-600">{{ $message }}</p> @enderror

                <div class="grid gap-3 md:grid-cols-2">
                    @foreach($sizes as $size)
                        <label class="flex items-center justify-between gap-4 rounded-[14px] border border-mega-line bg-mega-soft px-4 py-4">
                            <span>
                                <strong class="block text-mega-black">{{ $size->label }}</strong>
                                <small class="text-mega-muted">{{ number_format($size->sqm, 2) }}m²</small>
                            </span>

                            <input
                                type="checkbox"
                                name="selected_size_option_ids[]"
                                value="{{ $size->id }}"
                                @checked(in_array((int) $size->id, $selectedSizeIds, true))
                            >
                        </label>
                    @endforeach
                </div>

                @if(!$sizes->count())
                    <p class="mt-4 text-sm text-red-600">
                        Please create area sizes first from Admin → Area Sizes.
                    </p>
                @endif
            </div>

            <div class="mt-6 hidden rounded-[14px] border border-orange-200 bg-orange-50 px-4 py-3 text-sm font-semibold text-orange-900" data-rug-price-note>
                Rug products use one fixed price only. Size selection is hidden on the frontend.
            </div>
        </div>
    </div>

    <aside class="space-y-6">
        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Images</p>
            <h2 class="text-xl text-mega-black">Upload Product Images</h2>

            <div class="mt-5">
                <label class="mb-2 block text-sm font-medium text-mega-text">
                    Main Image {{ $product->exists ? '' : '*' }}
                </label>

                @if($product->exists && $product->main_image)
                    <div class="mb-3 overflow-hidden rounded-[14px] border border-mega-line bg-mega-soft">
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                    </div>
                @endif

                <input
                    type="file"
                    name="main_image_file"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm"
                    {{ $product->exists ? '' : 'required' }}
                >

                <p class="mt-1 text-xs text-mega-muted">JPG, PNG or WebP. Max 4MB.</p>
                @error('main_image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6">
                <label class="mb-2 block text-sm font-medium text-mega-text">
                    Gallery Images + Colour Name
                </label>

                <div id="existingGalleryRows" class="space-y-3">
                    @foreach(($product->galleryImages ?? collect()) as $galleryImage)
                        <div class="existing-gallery-row rounded-[14px] border border-mega-line bg-mega-soft p-3">
                            <input type="hidden" name="existing_gallery_ids[]" value="{{ $galleryImage->id }}">

                            <img
                                src="{{ $galleryImage->imageUrl() }}"
                                alt="Gallery image"
                                class="h-32 w-full rounded-[10px] object-cover"
                            >

                            <label class="mb-2 mt-3 block text-xs font-semibold text-mega-muted">
                                Colour Name
                            </label>

                            <input
                                type="text"
                                name="existing_gallery_colour_names[{{ $galleryImage->id }}]"
                                value="{{ old('existing_gallery_colour_names.' . $galleryImage->id, $galleryImage->colour_name) }}"
                                class="input-clean"
                                placeholder="e.g. Stone Grey, Light Oak, Charcoal"
                            >

                            <button type="button" class="remove-existing-gallery mt-3 w-full rounded-[10px] bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>

                <div id="galleryRows" class="mt-3 space-y-3">
                    <div class="gallery-row rounded-[14px] border border-mega-line bg-white p-3">
                        <input
                            type="file"
                            name="gallery_images[]"
                            accept="image/jpeg,image/png,image/webp"
                            class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm"
                        >

                        <label class="mb-2 mt-3 block text-xs font-semibold text-mega-muted">
                            Colour Name
                        </label>

                        <input
                            type="text"
                            name="gallery_colour_names[]"
                            class="input-clean"
                            placeholder="e.g. Stone Grey, Light Oak, Charcoal"
                        >

                        <button type="button" class="remove-gallery mt-3 w-full rounded-[10px] bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">
                            Remove
                        </button>
                    </div>
                </div>

                <button type="button" id="addGallery" class="btn-light mt-4">
                    Add Gallery Image +
                </button>

                <p class="mt-1 text-xs text-mega-muted">Each gallery image can have its own colour name.</p>
                @error('gallery_images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Filters</p>

            <label class="mb-2 block text-sm font-medium text-mega-text">Size Group</label>
            <input type="text" name="size_group" value="{{ old('size_group', $product->size_group) }}" class="input-clean" placeholder="Small, Medium, Large">

            <label class="mb-2 mt-5 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?: 0) }}" class="input-clean">
        </div>

        <div class="clean-card bg-white p-6">
            <label class="mq-check">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))>
                <span>Active / visible on frontend</span>
            </label>

            <button type="submit" class="btn-primary mt-6 w-full justify-center">
                Save Product Range
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn-light mt-3 w-full justify-center">
                Cancel
            </a>
        </div>
    </aside>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('productCategorySelect');
        const sizeWrap = document.querySelector('[data-size-selection-wrap]');
        const rugNote = document.querySelector('[data-rug-price-note]');
        const priceLabel = document.querySelector('[data-price-label]');

        function syncPriceModeUI() {
            const selected = categorySelect?.options[categorySelect.selectedIndex];
            const slug = selected?.dataset.slug || '';
            const isRug = slug === 'rugs';

            if (sizeWrap) {
                sizeWrap.classList.toggle('hidden', isRug);
            }

            if (rugNote) {
                rugNote.classList.toggle('hidden', !isRug);
            }

            if (priceLabel) {
                priceLabel.textContent = isRug ? 'Fixed Rug Price *' : 'Price for 1m² *';
            }
        }

        categorySelect?.addEventListener('change', syncPriceModeUI);
        syncPriceModeUI();

        const galleryRows = document.getElementById('galleryRows');
        const addGalleryButton = document.getElementById('addGallery');

        function bindGalleryRemoveButtons() {
            document.querySelectorAll('.remove-gallery').forEach((button) => {
                button.onclick = function () {
                    const rows = document.querySelectorAll('.gallery-row');

                    if (rows.length <= 1) {
                        const row = button.closest('.gallery-row');
                        const fileInput = row.querySelector('input[type="file"]');
                        const textInput = row.querySelector('input[type="text"]');

                        if (fileInput) fileInput.value = '';
                        if (textInput) textInput.value = '';
                        return;
                    }

                    button.closest('.gallery-row').remove();
                };
            });

            document.querySelectorAll('.remove-existing-gallery').forEach((button) => {
                button.onclick = function () {
                    button.closest('.existing-gallery-row').remove();
                };
            });
        }

        addGalleryButton?.addEventListener('click', function () {
            const div = document.createElement('div');

            div.className = 'gallery-row rounded-[14px] border border-mega-line bg-white p-3';

            div.innerHTML = `
                <input
                    type="file"
                    name="gallery_images[]"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm"
                >

                <label class="mb-2 mt-3 block text-xs font-semibold text-mega-muted">
                    Colour Name
                </label>

                <input
                    type="text"
                    name="gallery_colour_names[]"
                    class="input-clean"
                    placeholder="e.g. Stone Grey, Light Oak, Charcoal"
                >

                <button type="button" class="remove-gallery mt-3 w-full rounded-[10px] bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">
                    Remove
                </button>
            `;

            galleryRows.appendChild(div);
            bindGalleryRemoveButtons();
        });

        bindGalleryRemoveButtons();
    });
</script>