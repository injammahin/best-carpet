@extends('layouts.admin')

@section('title', 'Reviews | Mega Carpets Admin')
@section('page_title', 'Reviews')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Customer feedback</p>
            <h1 class="text-3xl text-mega-black">Reviews</h1>
            <p class="mt-2 text-sm text-mega-muted">Manage homepage review slider content.</p>
        </div>

        <a href="{{ route('admin.reviews.create') }}" class="btn-primary w-fit">Add Review</a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="clean-card overflow-hidden bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4">Featured</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-mega-line">
                    @forelse($reviews as $review)
                        <tr>
                            <td class="px-6 py-5">
                                <p class="font-semibold text-mega-black">{{ $review->customer_name }}</p>
                                <p class="mt-1 text-sm text-mega-muted">{{ $review->location ?: 'No location' }}</p>
                            </td>

                            <td class="px-6 py-5 text-mega-orange">
                                {{ str_repeat('★', $review->rating) }}
                            </td>

                            <td class="px-6 py-5">
                                {{ $review->is_featured ? 'Yes' : 'No' }}
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold {{ $review->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $review->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.reviews.edit', $review) }}"
                                        class="rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">Edit</a>

                                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}"
                                        onsubmit="return confirm('Delete this review?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-[10px] bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-mega-muted">No reviews added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
            <div class="border-t border-mega-line p-6">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>

@endsection