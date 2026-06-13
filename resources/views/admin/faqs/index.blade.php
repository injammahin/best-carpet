@extends('layouts.admin')

@section('title', 'FAQs | Mega Carpets Admin')
@section('page_title', 'FAQs')

@section('content')

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <p class="section-label mb-2">Helpful answers</p>
            <h1 class="text-3xl text-mega-black">FAQs</h1>
            <p class="mt-2 text-sm text-mega-muted">Manage homepage frequently asked questions.</p>
        </div>

        <a href="{{ route('admin.faqs.create') }}" class="btn-primary w-fit">Add FAQ</a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="clean-card overflow-hidden bg-white">
        <table class="min-w-full text-left">
            <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                <tr>
                    <th class="px-6 py-4">Question</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-mega-line">
                @forelse($faqs as $faq)
                    <tr>
                        <td class="px-6 py-5 font-semibold text-mega-black">{{ $faq->question }}</td>
                        <td class="px-6 py-5 text-mega-muted">{{ $faq->category ?: 'General' }}</td>
                        <td class="px-6 py-5">
                            <span
                                class="rounded-full px-3 py-1 text-xs font-semibold {{ $faq->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.faqs.edit', $faq) }}"
                                    class="rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white">Edit</a>

                                <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}"
                                    onsubmit="return confirm('Delete this FAQ?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-mega-muted">No FAQs added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($faqs->hasPages())
            <div class="border-t border-mega-line p-6">
                {{ $faqs->links() }}
            </div>
        @endif
    </div>

@endsection