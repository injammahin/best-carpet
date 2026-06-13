@extends('layouts.admin')

@section('title', 'Product Categories | Mega Carpets Admin')
@section('page_title', 'Product Categories')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Categories and carpet subcategories</p>
            <h1 class="text-3xl text-mega-black">Product Categories</h1>
            <p class="mt-2 text-sm text-mega-muted">
                Add or delete carpet dropdown items like Nylon Carpet, Wool Carpet, Triexta Carpet.
            </p>
        </div>

        <a href="{{ route('admin.product-categories.create') }}" class="btn-primary w-fit">
            Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="clean-card bg-white p-6">
        <div class="grid gap-4">
            @foreach($categories as $category)
                <div class="rounded-[18px] border border-mega-line bg-mega-soft p-5">
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                        <div>
                            <p class="text-xl font-semibold text-mega-black">{{ $category->name }}</p>
                            <p class="mt-1 text-sm text-mega-muted">/{{ $category->slug }}</p>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.product-categories.edit', $category) }}"
                                class="rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.product-categories.destroy', $category) }}"
                                onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="rounded-[10px] bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    @if($category->children->count())
                        <div class="mt-4 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($category->children as $child)
                                <div class="flex items-center justify-between gap-3 rounded-[14px] bg-white p-4">
                                    <div>
                                        <p class="font-semibold text-mega-black">{{ $child->name }}</p>
                                        <p class="mt-1 text-xs text-mega-muted">/{{ $child->slug }}</p>
                                    </div>

                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.product-categories.edit', $child) }}"
                                            class="text-sm font-semibold text-mega-orange">Edit</a>

                                        <form method="POST" action="{{ route('admin.product-categories.destroy', $child) }}"
                                            onsubmit="return confirm('Delete this subcategory?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-red-600">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection