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

<div class="clean-card bg-white p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Parent Category</label>
            <select name="parent_id" class="input-clean">
                <option value="">Top-level category</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            <p class="mt-1 text-xs text-mega-muted">
                For carpet dropdown items, select Carpet as parent.
            </p>
            @error('parent_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Name *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="input-clean" required>
            <p class="mt-1 text-xs text-mega-muted">
                Slug will be generated automatically.
            </p>
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-mega-text">Category Image</label>

            @if($category->exists && $category->image_url)
                <div class="mb-3 overflow-hidden rounded-[14px] border border-mega-line bg-mega-soft">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="h-52 w-full object-cover">
                </div>
            @endif

            <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp"
                class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm">

            <p class="mt-1 text-xs text-mega-muted">JPG, PNG or WebP. Max 4MB.</p>
            @error('image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-mega-text">Short Description</label>
            <textarea name="short_description" rows="3"
                class="input-clean">{{ old('short_description', $category->short_description) }}</textarea>
            @error('short_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-mega-text">Description</label>
            <textarea name="description" rows="5"
                class="input-clean">{{ old('description', $category->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?: 0) }}"
                class="input-clean">
            @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center">
            <label class="mq-check mt-7">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->exists ? $category->is_active : true))>
                <span>Active</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="btn-primary">
            Save Category
        </button>

        <a href="{{ route('admin.product-categories.index') }}" class="btn-light">
            Cancel
        </a>
    </div>
</div>