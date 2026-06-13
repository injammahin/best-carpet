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
            <label class="mb-2 block text-sm font-medium text-mega-text">Category</label>
            <input type="text" name="category" value="{{ old('category', $faq->category ?: 'General') }}"
                class="input-clean">
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-mega-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?: 0) }}"
                class="input-clean">
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-mega-text">Question *</label>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="input-clean"
                required>
        </div>

        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-mega-text">Answer *</label>
            <textarea name="answer" rows="8" class="input-clean" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="flex items-center gap-2 text-sm font-semibold text-mega-text">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->exists ? $faq->is_active : true))>
                Active
            </label>
        </div>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="btn-primary">Save FAQ</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn-light">Cancel</a>
    </div>
</div>