<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="max-w-5xl">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            Please check the form fields and try again.
        </div>
    @endif

    <div class="clean-card bg-white p-6">
        <p class="section-label mb-2">Promo details</p>
        <h1 class="text-3xl text-mega-black">
            {{ $promo->exists ? 'Edit Promo Slide' : 'Add Promo Slide' }}
        </h1>

        <div class="mt-6 grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Title *</label>
                <input type="text" name="title" value="{{ old('title', $promo->title) }}" class="input-clean" required>
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $promo->sort_order ?? 0) }}"
                    class="input-clean">
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-mega-text">Subtitle</label>
                <textarea name="subtitle" rows="3"
                    class="input-clean">{{ old('subtitle', $promo->subtitle) }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Button Text</label>
                <input type="text" name="button_text" value="{{ old('button_text', $promo->button_text) }}"
                    class="input-clean" placeholder="Shop now">
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-mega-text">Button URL</label>
                <input type="text" name="button_url" value="{{ old('button_url', $promo->button_url) }}"
                    class="input-clean" placeholder="/products/carpet">
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-mega-text">
                    Promo Image {{ $promo->exists ? '' : '*' }}
                </label>

                <input type="file" name="image_file" class="input-clean" {{ $promo->exists ? '' : 'required' }}>
                <p class="mt-2 text-xs text-mega-muted">Recommended size: 1600 x 700px. JPG, PNG or WebP.</p>

                @if($promo->exists && $promo->image)
                    <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}"
                        class="mt-4 h-56 w-full rounded-[7px] object-cover">
                @endif
            </div>

            <label class="flex items-center gap-3 md:col-span-2">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $promo->is_active ?? true))>
                <span class="text-sm font-semibold text-mega-black">Active</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="btn-primary">
            Save Promo
        </button>

        <a href="{{ route('admin.special-promos.index') }}" class="btn-light">
            Cancel
        </a>
    </div>
</form>