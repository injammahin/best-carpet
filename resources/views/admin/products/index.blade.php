@extends('layouts.admin')

@section('title', 'Products | Mega Carpets Admin')
@section('page_title', 'Products')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Product catalogue</p>
            <h1 class="text-3xl text-mega-black">Product Ranges</h1>
            <p class="mt-2 text-sm text-mega-muted">
                Each product has one base price. Flooring products calculate by selected room size, while rugs use one fixed
                price.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn-primary w-fit">
            Add Product Range
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="clean-card overflow-hidden bg-white">
        <div class="border-b border-mega-line p-6">
            <form method="GET" class="grid gap-3 md:grid-cols-[1fr_220px_auto]">
                <input type="text" name="search" value="{{ request('search') }}" class="input-clean"
                    placeholder="Search product range...">

                <select name="category_id" class="input-clean">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-primary justify-center">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                    <tr>
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">From Price</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-mega-line">
                    @forelse($products as $product)
                        <tr>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}"
                                        class="h-16 w-16 rounded-[12px] object-cover">

                                    <div>
                                        <p class="font-semibold text-mega-black">{{ $product->name }}</p>
                                        <p class="mt-1 text-xs text-mega-muted">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <p class="text-sm font-medium text-mega-black">{{ $product->category?->name }}</p>
                                <p class="mt-1 text-xs text-mega-muted">{{ $product->subcategory?->name ?: 'No subcategory' }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold {{ $product->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-semibold text-mega-black">
                                    @if($product->isRug())
                                        ${{ number_format($product->priceFrom(), 2) }} fixed
                                    @else
                                        ${{ number_format($product->priceFrom(), 2) }}/m²
                                    @endif
                                </p>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                        onsubmit="return confirm('Delete this product range?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-[10px] bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <p class="text-lg font-semibold text-mega-black">No products found.</p>
                                <a href="{{ route('admin.products.create') }}" class="btn-primary mt-5">Add first product</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="border-t border-mega-line p-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>

@endsection