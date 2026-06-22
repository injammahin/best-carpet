@extends('layouts.admin')

@section('title', 'Specials | Mega Carpets Admin')
@section('page_title', 'Specials')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Promo slider</p>
            <h1 class="text-3xl text-mega-black">Specials</h1>
            <p class="mt-2 text-sm text-mega-muted">
                Manage up to 3 rotating promo images for the public Specials page.
            </p>
        </div>

        @if($promos->count() < 3)
            <a href="{{ route('admin.special-promos.create') }}" class="btn-primary w-fit">
                Add Promo Slide
            </a>
        @endif
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

    <div class="grid gap-5 lg:grid-cols-3">
        @forelse($promos as $promo)
            <div class="clean-card overflow-hidden bg-white">
                <img src="{{ $promo->imageUrl() }}" alt="{{ $promo->title }}" class="h-56 w-full object-cover">

                <div class="p-5">
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <span
                            class="rounded-full px-3 py-1 text-xs font-semibold {{ $promo->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $promo->is_active ? 'Active' : 'Inactive' }}
                        </span>

                        <span class="text-xs font-semibold uppercase tracking-[0.16em] text-mega-muted">
                            Sort {{ $promo->sort_order }}
                        </span>
                    </div>

                    <h2 class="text-xl font-black text-mega-black">
                        {{ $promo->title }}
                    </h2>

                    <p class="mt-2 min-h-[48px] text-sm leading-6 text-mega-muted">
                        {{ $promo->subtitle ?: 'No subtitle added.' }}
                    </p>

                    <div class="mt-5 flex gap-2">
                        <a href="{{ route('admin.special-promos.edit', $promo) }}"
                            class="rounded-[7px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.special-promos.destroy', $promo) }}"
                            onsubmit="return confirm('Delete this promo slide?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="rounded-[7px] bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="clean-card bg-white p-10 text-center lg:col-span-3">
                <h2 class="text-2xl font-black text-mega-black">No specials added yet.</h2>
                <p class="mt-2 text-mega-muted">Add up to 3 promo slides for the Specials page.</p>

                <a href="{{ route('admin.special-promos.create') }}" class="btn-primary mt-5">
                    Add first promo
                </a>
            </div>
        @endforelse
    </div>

@endsection