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

<div class="grid gap-6 xl:grid-cols-[1fr_380px]">
    <div class="space-y-6">
        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Product range</p>
            <h2 class="text-2xl text-mega-black">Basic Details</h2>

            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Category *</label>
                    <select name="category_id" class="input-clean" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
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
                    <p class="mt-1 text-xs text-mega-muted">Use this for Carpet types like Nylon Carpet or Wool Carpet.
                    </p>
                    @error('subcategory_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Range Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-clean"
                        required>
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Badge</label>
                    <input type="text" name="badge" value="{{ old('badge', $product->badge ?: 'Popular') }}"
                        class="input-clean">
                    @error('badge') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Rating</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating"
                        value="{{ old('rating', $product->rating ?: 4.8) }}" class="input-clean">
                    @error('rating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-mega-text">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', $product->unit ?: 'm²') }}"
                        class="input-clean">
                    @error('unit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-mega-text">Short Description *</label>
                    <textarea name="short_description" rows="3" class="input-clean"
                        required>{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-mega-text">Full Description</label>
                    <textarea name="description" rows="5"
                        class="input-clean">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Colours</p>
            <h2 class="text-2xl text-mega-black">Range Colours</h2>
            <p class="mt-2 text-sm text-mega-muted">
                Enter a colour code or choose from the picker. The colour name and group will be generated automatically, but you can edit them.
            </p>

            @error('colour_names') <p class="mt-3 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('colour_swatches') <p class="mt-3 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('colour_groups') <p class="mt-3 text-sm text-red-600">{{ $message }}</p> @enderror

            <div id="colourRows" class="mt-6 space-y-3">
                @php
                    $oldColourNames = old('colour_names');

                    $colourRows = $oldColourNames
                        ? collect($oldColourNames)->map(fn($name, $index) => [
                            'name' => $name,
                            'swatch' => old('colour_swatches.' . $index, '#d8c7b5'),
                            'group' => old('colour_groups.' . $index),
                        ])
                        : $product->colours->map(fn($colour) => [
                            'name' => $colour->name,
                            'swatch' => $colour->swatch,
                            'group' => $colour->colour_group,
                        ]);

                    if (!$colourRows->count()) {
                        $colourRows = collect([
                            ['name' => '', 'swatch' => '#d8c7b5', 'group' => 'Neutral']
                        ]);
                    }
                @endphp

                @foreach($colourRows as $colour)
                    @php
                        $safeSwatch = $colour['swatch'] ?: '#d8c7b5';
                        $safeSwatch = str_starts_with($safeSwatch, '#') ? $safeSwatch : '#' . $safeSwatch;
                    @endphp

                    <div class="colour-row grid gap-3 md:grid-cols-[1fr_145px_120px_160px_42px]">
                        <input
                            type="text"
                            name="colour_names[]"
                            value="{{ $colour['name'] }}"
                            class="input-clean colour-name-input"
                            placeholder="Auto colour name"
                        >

                        <input
                            type="text"
                            value="{{ $safeSwatch }}"
                            class="input-clean colour-code-input font-mono uppercase"
                            placeholder="#D8C7B5"
                            maxlength="7"
                        >

                        <input
                            type="color"
                            name="colour_swatches[]"
                            value="{{ $safeSwatch }}"
                            class="colour-picker-input h-[56px] w-full rounded-[14px] border border-mega-line bg-white p-2"
                        >

                        <input
                            type="text"
                            name="colour_groups[]"
                            value="{{ $colour['group'] }}"
                            class="input-clean colour-group-input"
                            placeholder="Auto group"
                        >

                        <button type="button" class="remove-colour rounded-[14px] border border-red-200 bg-red-50 text-red-700">×</button>
                    </div>
                @endforeach
            </div>

            <button type="button" id="addColour" class="btn-light mt-4">
                Add Colour +
            </button>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Pricing</p>
            <h2 class="text-2xl text-mega-black">Price by Range + Size</h2>
            <p class="mt-2 text-sm text-mega-muted">
                Colour does not change price. Only this product range and selected size change price.
            </p>

            @error('prices') <p class="mt-3 text-sm text-red-600">{{ $message }}</p> @enderror

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                        <tr>
                            <th class="px-4 py-3">Area Size</th>
                            <th class="px-4 py-3">SQM</th>
                            <th class="px-4 py-3">Sale Price *</th>
                            <th class="px-4 py-3">Regular Price</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-mega-line">
                        @foreach($sizes as $size)
                            @php $price = $priceMap->get($size->id); @endphp

                            <tr>
                                <td class="px-4 py-3 font-semibold text-mega-black">{{ $size->label }}</td>
                                <td class="px-4 py-3 text-mega-muted">{{ $size->sqm }}m²</td>
                                <td class="px-4 py-3">
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="prices[{{ $size->id }}]"
                                        value="{{ old('prices.' . $size->id, $price?->price) }}"
                                        class="input-clean"
                                        placeholder="e.g. 499"
                                    >
                                </td>
                                <td class="px-4 py-3">
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="regular_prices[{{ $size->id }}]"
                                        value="{{ old('regular_prices.' . $size->id, $price?->regular_price) }}"
                                        class="input-clean"
                                        placeholder="optional"
                                    >
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(!$sizes->count())
                <p class="mt-4 text-sm text-red-600">
                    Please create area sizes first from Admin → Area Sizes.
                </p>
            @endif
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
                    Gallery Images
                </label>

                <div id="existingGalleryRows" class="space-y-3">
                    @foreach(($product->gallery ?: []) as $galleryImage)
                        <div class="existing-gallery-row rounded-[14px] border border-mega-line bg-mega-soft p-3">
                            <input type="hidden" name="existing_gallery[]" value="{{ $galleryImage }}">

                            <img
                                src="{{ \Illuminate\Support\Str::startsWith($galleryImage, ['http://', 'https://']) ? $galleryImage : asset('storage/' . ltrim($galleryImage, '/')) }}"
                                alt="Gallery image"
                                class="h-32 w-full rounded-[10px] object-cover"
                            >

                            <button type="button" class="remove-existing-gallery mt-3 w-full rounded-[10px] bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>

                <div id="galleryRows" class="mt-3 space-y-3">
                    <div class="gallery-row flex gap-2">
                        <input
                            type="file"
                            name="gallery_images[]"
                            accept="image/jpeg,image/png,image/webp"
                            class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm"
                        >

                        <button type="button" class="remove-gallery rounded-[14px] border border-red-200 bg-red-50 px-4 text-red-700">
                            ×
                        </button>
                    </div>
                </div>

                <button type="button" id="addGallery" class="btn-light mt-4">
                    Add Gallery Image +
                </button>

                <p class="mt-1 text-xs text-mega-muted">You can add as many gallery images as you want.</p>
                @error('gallery_images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Filters</p>

            <label class="mb-2 block text-sm font-medium text-mega-text">Colour Group</label>
            <input type="text" name="colour_group" value="{{ old('colour_group', $product->colour_group) }}" class="input-clean" placeholder="Neutral, Grey, Brown">

            <label class="mb-2 mt-5 block text-sm font-medium text-mega-text">Size Group</label>
            <input type="text" name="size_group" value="{{ old('size_group', $product->size_group) }}" class="input-clean" placeholder="Small, Medium, Large">

            <label class="mb-2 mt-5 block text-sm font-medium text-mega-text">Room</label>
            <input type="text" name="room" value="{{ old('room', $product->room) }}" class="input-clean" placeholder="Bedroom, Lounge, Hallway">
        </div>

        <div class="clean-card bg-white p-6">
            <p class="section-label mb-2">Features</p>

            <textarea name="features" rows="6" class="input-clean" placeholder="One feature per line">{{ old('features', implode("\n", $product->features ?: [])) }}</textarea>
        </div>

        <div class="clean-card bg-white p-6">
            <label class="mq-check">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))>
                <span>Active / visible on frontend</span>
            </label>

            <label class="mb-2 mt-5 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?: 0) }}" class="input-clean">

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
        const colourRows = document.getElementById('colourRows');
        const addColourButton = document.getElementById('addColour');

        const colourFamilies = [
            { name: 'Black', group: 'Black', hex: '#000000' },
            { name: 'White', group: 'White', hex: '#ffffff' },
            { name: 'Cream', group: 'Neutral', hex: '#f5ead6' },
            { name: 'Beige', group: 'Neutral', hex: '#d8c7b5' },
            { name: 'Taupe', group: 'Neutral', hex: '#b8a99a' },
            { name: 'Stone', group: 'Neutral', hex: '#9f968c' },
            { name: 'Grey', group: 'Grey', hex: '#9ca3af' },
            { name: 'Charcoal', group: 'Grey', hex: '#374151' },
            { name: 'Brown', group: 'Brown', hex: '#8b5e3c' },
            { name: 'Chocolate', group: 'Brown', hex: '#5a3825' },
            { name: 'Tan', group: 'Brown', hex: '#c59b6d' },
            { name: 'Blue', group: 'Blue', hex: '#3b82f6' },
            { name: 'Navy', group: 'Blue', hex: '#1e3a8a' },
            { name: 'Green', group: 'Green', hex: '#16a34a' },
            { name: 'Olive', group: 'Green', hex: '#6b7d3a' },
            { name: 'Red', group: 'Red', hex: '#dc2626' },
            { name: 'Burgundy', group: 'Red', hex: '#7f1d1d' },
            { name: 'Orange', group: 'Orange', hex: '#f97316' },
            { name: 'Yellow', group: 'Yellow', hex: '#eab308' },
            { name: 'Purple', group: 'Purple', hex: '#7c3aed' },
            { name: 'Pink', group: 'Pink', hex: '#ec4899' },
        ];

        function normalizeHex(value) {
            value = String(value || '').trim().replace(/[^0-9a-fA-F#]/g, '');

            if (!value) {
                return '';
            }

            if (value[0] !== '#') {
                value = '#' + value;
            }

            if (/^#[0-9a-fA-F]{3}$/.test(value)) {
                value = '#' + value[1] + value[1] + value[2] + value[2] + value[3] + value[3];
            }

            if (!/^#[0-9a-fA-F]{6}$/.test(value)) {
                return '';
            }

            return value.toUpperCase();
        }

        function hexToRgb(hex) {
            hex = normalizeHex(hex);

            if (!hex) {
                return null;
            }

            return {
                r: parseInt(hex.slice(1, 3), 16),
                g: parseInt(hex.slice(3, 5), 16),
                b: parseInt(hex.slice(5, 7), 16),
            };
        }

        function rgbToHsl(r, g, b) {
            r /= 255;
            g /= 255;
            b /= 255;

            const max = Math.max(r, g, b);
            const min = Math.min(r, g, b);
            let h = 0;
            let s = 0;
            const l = (max + min) / 2;

            if (max !== min) {
                const d = max - min;
                s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

                if (max === r) {
                    h = (g - b) / d + (g < b ? 6 : 0);
                } else if (max === g) {
                    h = (b - r) / d + 2;
                } else {
                    h = (r - g) / d + 4;
                }

                h /= 6;
            }

            return {
                h: Math.round(h * 360),
                s: Math.round(s * 100),
                l: Math.round(l * 100),
            };
        }

        function colourDistance(hexA, hexB) {
            const a = hexToRgb(hexA);
            const b = hexToRgb(hexB);

            if (!a || !b) {
                return Number.MAX_SAFE_INTEGER;
            }

            return Math.sqrt(
                Math.pow(a.r - b.r, 2) +
                Math.pow(a.g - b.g, 2) +
                Math.pow(a.b - b.b, 2)
            );
        }

        function nearestColourFamily(hex) {
            let closest = colourFamilies[0];
            let closestDistance = Number.MAX_SAFE_INTEGER;

            colourFamilies.forEach((family) => {
                const distance = colourDistance(hex, family.hex);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    closest = family;
                }
            });

            return closest;
        }

        function generateColourName(hex) {
            const rgb = hexToRgb(hex);

            if (!rgb) {
                return {
                    name: '',
                    group: '',
                };
            }

            const hsl = rgbToHsl(rgb.r, rgb.g, rgb.b);
            const family = nearestColourFamily(hex);

            let tone = '';

            if (hsl.l >= 88) {
                tone = 'Very Light';
            } else if (hsl.l >= 74) {
                tone = 'Light';
            } else if (hsl.l <= 18) {
                tone = 'Deep';
            } else if (hsl.l <= 32) {
                tone = 'Dark';
            }

            let warmth = '';

            if (family.group === 'Neutral' || family.group === 'Grey' || family.group === 'Brown') {
                if (rgb.r > rgb.b + 18 && rgb.g > rgb.b + 5) {
                    warmth = 'Warm';
                } else if (rgb.b > rgb.r + 15) {
                    warmth = 'Cool';
                }
            }

            const parts = [tone, warmth, family.name].filter(Boolean);

            return {
                name: parts.join(' '),
                group: family.group,
            };
        }

        function updateColourRow(row, source) {
            const nameInput = row.querySelector('.colour-name-input');
            const codeInput = row.querySelector('.colour-code-input');
            const pickerInput = row.querySelector('.colour-picker-input');
            const groupInput = row.querySelector('.colour-group-input');

            let hex = '';

            if (source === 'picker') {
                hex = normalizeHex(pickerInput.value);
            } else {
                hex = normalizeHex(codeInput.value);
            }

            if (!hex) {
                return;
            }

            codeInput.value = hex;
            pickerInput.value = hex;

            const generated = generateColourName(hex);

            if (!nameInput.value.trim() || nameInput.dataset.autoName === '1') {
                nameInput.value = generated.name;
                nameInput.dataset.autoName = '1';
            }

            if (!groupInput.value.trim() || groupInput.dataset.autoGroup === '1') {
                groupInput.value = generated.group;
                groupInput.dataset.autoGroup = '1';
            }
        }

        function bindColourRows() {
            document.querySelectorAll('.colour-row').forEach((row) => {
                const nameInput = row.querySelector('.colour-name-input');
                const codeInput = row.querySelector('.colour-code-input');
                const pickerInput = row.querySelector('.colour-picker-input');
                const groupInput = row.querySelector('.colour-group-input');

                if (!row.dataset.bound) {
                    nameInput?.addEventListener('input', function () {
                        nameInput.dataset.autoName = nameInput.value.trim() ? '0' : '1';
                    });

                    groupInput?.addEventListener('input', function () {
                        groupInput.dataset.autoGroup = groupInput.value.trim() ? '0' : '1';
                    });

                    codeInput?.addEventListener('input', function () {
                        const normalized = normalizeHex(codeInput.value);

                        if (normalized) {
                            updateColourRow(row, 'code');
                        }
                    });

                    codeInput?.addEventListener('blur', function () {
                        const normalized = normalizeHex(codeInput.value);

                        if (normalized) {
                            updateColourRow(row, 'code');
                        }
                    });

                    pickerInput?.addEventListener('input', function () {
                        updateColourRow(row, 'picker');
                    });

                    row.dataset.bound = '1';
                }

                const initialHex = normalizeHex(pickerInput?.value || codeInput?.value);

                if (initialHex) {
                    codeInput.value = initialHex;
                    pickerInput.value = initialHex;
                }
            });

            document.querySelectorAll('.remove-colour').forEach((button) => {
                button.onclick = function () {
                    if (document.querySelectorAll('.colour-row').length <= 1) {
                        return;
                    }

                    button.closest('.colour-row').remove();
                };
            });
        }

        addColourButton?.addEventListener('click', function () {
            const div = document.createElement('div');

            div.className = 'colour-row grid gap-3 md:grid-cols-[1fr_145px_120px_160px_42px]';

            div.innerHTML = `
                <input
                    type="text"
                    name="colour_names[]"
                    class="input-clean colour-name-input"
                    placeholder="Auto colour name"
                >

                <input
                    type="text"
                    value="#D8C7B5"
                    class="input-clean colour-code-input font-mono uppercase"
                    placeholder="#D8C7B5"
                    maxlength="7"
                >

                <input
                    type="color"
                    name="colour_swatches[]"
                    value="#d8c7b5"
                    class="colour-picker-input h-[56px] w-full rounded-[14px] border border-mega-line bg-white p-2"
                >

                <input
                    type="text"
                    name="colour_groups[]"
                    class="input-clean colour-group-input"
                    placeholder="Auto group"
                >

                <button type="button" class="remove-colour rounded-[14px] border border-red-200 bg-red-50 text-red-700">×</button>
            `;

            colourRows.appendChild(div);
            bindColourRows();
            updateColourRow(div, 'code');
        });

        bindColourRows();

        document.querySelectorAll('.colour-row').forEach((row) => {
            const nameInput = row.querySelector('.colour-name-input');
            const groupInput = row.querySelector('.colour-group-input');

            if (!nameInput.value.trim()) {
                nameInput.dataset.autoName = '1';
            }

            if (!groupInput.value.trim()) {
                groupInput.dataset.autoGroup = '1';
            }

            updateColourRow(row, 'picker');
        });

        const galleryRows = document.getElementById('galleryRows');
        const addGalleryButton = document.getElementById('addGallery');

        function bindGalleryRemoveButtons() {
            document.querySelectorAll('.remove-gallery').forEach((button) => {
                button.onclick = function () {
                    const rows = document.querySelectorAll('.gallery-row');

                    if (rows.length <= 1) {
                        const input = button.closest('.gallery-row').querySelector('input[type="file"]');
                        if (input) input.value = '';
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

            div.className = 'gallery-row flex gap-2';
            div.innerHTML = `
                <input
                    type="file"
                    name="gallery_images[]"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm"
                >

                <button type="button" class="remove-gallery rounded-[14px] border border-red-200 bg-red-50 px-4 text-red-700">
                    ×
                </button>
            `;

            galleryRows.appendChild(div);
            bindGalleryRemoveButtons();
        });

        bindGalleryRemoveButtons();
    });
</script>