@extends('layouts.admin')

@section('title', 'Quote Requests | Mega Carpets Admin')
@section('page_title', 'Quote Requests')

@section('content')

    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="clean-card bg-white p-6">
            <p class="text-sm text-mega-muted">Total Requests</p>
            <h2 class="mt-3 text-4xl text-mega-black">{{ $stats['total'] }}</h2>
            <p class="mt-3 text-sm text-mega-muted">All quote form submissions.</p>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="text-sm text-mega-muted">Unread</p>
            <h2 class="mt-3 text-4xl text-mega-black">{{ $stats['unread'] }}</h2>
            <p class="mt-3 text-sm text-mega-muted">New requests needing attention.</p>
        </div>

        <div class="clean-card bg-white p-6">
            <p class="text-sm text-mega-muted">Today</p>
            <h2 class="mt-3 text-4xl text-mega-black">{{ $stats['today'] }}</h2>
            <p class="mt-3 text-sm text-mega-muted">Submitted today.</p>
        </div>

        <div class="clean-card bg-mega-black p-6 text-white">
            <p class="text-sm text-white/55">Booked</p>
            <h2 class="mt-3 text-4xl text-white">{{ $stats['booked'] }}</h2>
            <p class="mt-3 text-sm text-white/55">Confirmed measurement bookings.</p>
        </div>
    </div>

    <div class="clean-card mt-8 overflow-hidden bg-white">
        <div class="border-b border-mega-line p-6">
            <div class="flex flex-col justify-between gap-4 xl:flex-row xl:items-center">
                <div>
                    <p class="section-label mb-2">Customer enquiries</p>
                    <h2 class="text-2xl text-mega-black">Free Measure & Quote Requests</h2>
                    <p class="mt-2 text-sm text-mega-muted">
                        View customer details, installation address, product interests and booking preferences.
                    </p>
                </div>

                <form method="GET" action="{{ route('admin.quote-requests.index') }}"
                    class="grid gap-3 sm:grid-cols-[1fr_180px_auto]">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search name, email, phone, suburb..."
                        class="border border-mega-line bg-white px-4 py-3 text-sm outline-none transition focus:border-mega-orange focus:ring-4 focus:ring-orange-500/10 radius-7">

                    <select name="status"
                        class="border border-mega-line bg-white px-4 py-3 text-sm outline-none transition focus:border-mega-orange focus:ring-4 focus:ring-orange-500/10 radius-7">
                        <option value="all" @selected(request('status', 'all') === 'all')>All</option>
                        <option value="unread" @selected(request('status') === 'unread')>Unread</option>
                        <option value="new" @selected(request('status') === 'new')>New</option>
                        <option value="contacted" @selected(request('status') === 'contacted')>Contacted</option>
                        <option value="booked" @selected(request('status') === 'booked')>Booked</option>
                        <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                        <option value="archived" @selected(request('status') === 'archived')>Archived</option>
                    </select>

                    <button type="submit" class="btn-primary justify-center">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div
                class="mx-6 mt-6 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="border-b border-mega-line bg-mega-soft text-xs uppercase tracking-[0.16em] text-mega-muted">
                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Contact</th>
                        <th class="px-6 py-4">Job</th>
                        <th class="px-6 py-4">Products</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Submitted</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-mega-line">
                    @forelse($quoteRequests as $quote)
                        <tr class="{{ $quote->is_unread ? 'bg-mega-orange/5' : 'bg-white' }}">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    @if($quote->is_unread)
                                        <span class="h-2.5 w-2.5 rounded-full bg-mega-orange"></span>
                                    @else
                                        <span class="h-2.5 w-2.5 rounded-full bg-transparent"></span>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-mega-black">{{ $quote->full_name }}</p>
                                        <p class="mt-1 text-xs text-mega-muted">
                                            {{ $quote->company ?: 'No company' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <p class="text-sm font-medium text-mega-black">{{ $quote->phone }}</p>
                                <p class="mt-1 text-xs text-mega-muted">{{ $quote->email }}</p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="text-sm font-medium text-mega-black">
                                    {{ collect($quote->job_type)->map(fn($item) => ucfirst($item))->join(', ') }}
                                </p>
                                <p class="mt-1 text-xs text-mega-muted">
                                    {{ $quote->suburb }} {{ $quote->postcode }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <p class="max-w-[240px] text-sm text-mega-muted">
                                    {{ collect($quote->products)->join(', ') }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex border px-3 py-1 text-xs font-semibold radius-7 {{ $quote->status_class }}">
                                    {{ $quote->status_label }}
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <p class="text-sm text-mega-black">{{ $quote->created_at->format('d M Y') }}</p>
                                <p class="mt-1 text-xs text-mega-muted">{{ $quote->created_at->format('h:i A') }}</p>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <a href="{{ route('admin.quote-requests.show', $quote) }}"
                                    class="inline-flex items-center justify-center rounded-[10px] bg-mega-orange px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-600">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <p class="text-lg font-semibold text-mega-black">No quote requests found.</p>
                                <p class="mt-2 text-sm text-mega-muted">New customer submissions will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($quoteRequests->hasPages())
            <div class="border-t border-mega-line p-6">
                {{ $quoteRequests->links() }}
            </div>
        @endif
    </div>

@endsection