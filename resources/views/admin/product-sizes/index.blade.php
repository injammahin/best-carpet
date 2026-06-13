@extends('layouts.admin')

@section('title', 'Area Sizes | Mega Carpets Admin')
@section('page_title', 'Area Sizes')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Area size options</p>
            <h1 class="text-3xl text-mega-black">Area Sizes</h1>
            <p class="mt-2 text-sm text-mega-muted">
                These sizes are reused for all ranges. Each range can have its own price for each size.
            </p>
        </div>

        <a href="{{ route('admin.product-sizes.create') }}" class="btn-primary w-fit">
            Add Area Size
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

    <div class="clean-card overflow-hidden bg-white">
        <table class="min-w-full text-left">
            <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                <tr>
                    <th class="px-6 py-4">Label</th>
                    <th class="px-6 py-4">SQM</th>
                    <th class="px-6 py-4">Group</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-mega-line">
                @foreach($sizes as $size)
                    <tr>
                        <td class="px-6 py-5 font-semibold text-mega-black">{{ $size->label }}</td>
                        <td class="px-6 py-5 text-mega-muted">{{ $size->sqm }}m²</td>
                        <td class="px-6 py-5 text-mega-muted">{{ $size->size_group }}</td>
                        <td class="px-6 py-5">
                            <span
                                class="rounded-full px-3 py-1 text-xs font-semibold {{ $size->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $size->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.product-sizes.edit', $size) }}"
                                    class="rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.product-sizes.destroy', $size) }}"
                                    onsubmit="return confirm('Delete this size?')">
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
                @endforeach
            </tbody>
        </table>
    </div>

@endsection