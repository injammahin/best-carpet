<div class="clean-card bg-white p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Label *</label>
            <input type="text" name="label" value="{{ old('label', $size->label) }}" class="input-clean"
                placeholder="Small Room / 10m²" required>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Square Metres *</label>
            <input type="number" step="0.01" name="sqm" value="{{ old('sqm', $size->sqm) }}" class="input-clean"
                required>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Size Group *</label>
            <input type="text" name="size_group" value="{{ old('size_group', $size->size_group ?: 'Standard') }}"
                class="input-clean" placeholder="Small, Medium, Large" required>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $size->sort_order ?: 0) }}"
                class="input-clean">
        </div>

        <div class="md:col-span-2">
            <label class="mq-check">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $size->exists ? $size->is_active : true))>
                <span>Active</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="btn-primary">
            Save Area Size
        </button>

        <a href="{{ route('admin.product-sizes.index') }}" class="btn-light">
            Cancel
        </a>
    </div>
</div>