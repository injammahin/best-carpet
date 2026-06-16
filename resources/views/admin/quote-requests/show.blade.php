@extends('layouts.admin')

@section('title', 'Quote Request Details | Mega Carpets Admin')
@section('page_title', 'Quote Request Details')

@section('content')

    @php
        $rawComments = trim((string) ($quoteRequest->comments ?? ''));

        $selectedQuoteProducts = [];
        $customerComment = '';
        $quoteProductNote = '';

        if ($rawComments !== '' && \Illuminate\Support\Str::contains($rawComments, 'Selected Products for Quote')) {
            $lines = preg_split('/\r\n|\r|\n/', $rawComments);
            $currentProduct = null;
            $captureCustomerComment = false;
            $customerCommentLines = [];

            foreach ($lines as $line) {
                $line = trim($line);

                if ($line === '' || $line === 'Selected Products for Quote') {
                    continue;
                }

                if ($line === 'Customer Additional Comments') {
                    if ($currentProduct) {
                        $selectedQuoteProducts[] = $currentProduct;
                        $currentProduct = null;
                    }

                    $captureCustomerComment = true;
                    continue;
                }

                if ($captureCustomerComment) {
                    $customerCommentLines[] = $line;
                    continue;
                }

                if (\Illuminate\Support\Str::startsWith($line, 'Note:')) {
                    if ($currentProduct) {
                        $selectedQuoteProducts[] = $currentProduct;
                        $currentProduct = null;
                    }

                    $quoteProductNote = $line;
                    continue;
                }

                if (preg_match('/^\d+\.\s*(.+)$/', $line, $matches)) {
                    if ($currentProduct) {
                        $selectedQuoteProducts[] = $currentProduct;
                    }

                    $currentProduct = [
                        'name' => $matches[1],
                        'category' => '',
                        'type' => '',
                        'size' => '',
                        'area' => '',
                        'estimate' => '',
                        'quantity' => '',
                    ];

                    continue;
                }

                if ($currentProduct && preg_match('/^([^:]+):\s*(.+)$/', $line, $matches)) {
                    $key = strtolower(trim($matches[1]));
                    $value = trim($matches[2]);

                    if ($key === 'category') {
                        $currentProduct['category'] = $value;
                    } elseif ($key === 'type') {
                        $currentProduct['type'] = $value;
                    } elseif ($key === 'size / area') {
                        $currentProduct['size'] = $value;
                    } elseif ($key === 'area') {
                        $currentProduct['area'] = $value;
                    } elseif ($key === 'rough estimate') {
                        $currentProduct['estimate'] = $value;
                    } elseif ($key === 'quantity') {
                        $currentProduct['quantity'] = $value;
                    }
                }
            }

            if ($currentProduct) {
                $selectedQuoteProducts[] = $currentProduct;
            }

            $customerComment = trim(implode("\n", array_filter($customerCommentLines)));
        } else {
            $customerComment = $rawComments;
        }
    @endphp

    <div class="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <a href="{{ route('admin.quote-requests.index') }}" class="text-sm font-semibold text-mega-orange">
                ← Back to quote requests
            </a>

            <h1 class="mt-3 text-3xl text-mega-black">
                {{ $quoteRequest->full_name }}
            </h1>

            <p class="mt-2 text-sm text-mega-muted">
                Submitted {{ $quoteRequest->created_at->format('d M Y, h:i A') }}
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <form method="POST" action="{{ route('admin.quote-requests.mark-unread', $quoteRequest) }}">
                @csrf
                @method('PATCH')

                <button type="submit"
                    class="border border-mega-line bg-white px-4 py-3 text-sm font-semibold text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                    Mark unread
                </button>
            </form>

            <form method="POST" action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}"
                onsubmit="return confirm('Delete this quote request?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-100 radius-7">
                    Delete
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-[1fr_360px]">
        <div class="space-y-6">
            <div class="clean-card bg-white p-6">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="section-label mb-2">Customer details</p>
                        <h2 class="text-2xl text-mega-black">Contact Information</h2>
                    </div>

                    <span
                        class="inline-flex border px-3 py-1 text-xs font-semibold radius-7 {{ $quoteRequest->status_class }}">
                        {{ $quoteRequest->status_label }}
                    </span>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Full Name</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->full_name }}</p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Company</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->company ?: 'Not provided' }}</p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Email</p>
                        <a href="mailto:{{ $quoteRequest->email }}" class="mt-2 block font-semibold text-mega-orange">
                            {{ $quoteRequest->email }}
                        </a>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Phone</p>
                        <a href="tel:{{ $quoteRequest->phone }}" class="mt-2 block font-semibold text-mega-orange">
                            {{ $quoteRequest->phone }}
                        </a>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Preferred Contact</p>
                        <p class="mt-2 font-semibold text-mega-black">
                            {{ collect($quoteRequest->preferred_contact)->map(fn($item) => ucfirst($item))->join(', ') ?: 'Not selected' }}
                        </p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Subscribed</p>
                        <p class="mt-2 font-semibold text-mega-black">
                            {{ $quoteRequest->subscribe ? 'Yes' : 'No' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Job details</p>
                <h2 class="text-2xl text-mega-black">Installation Information</h2>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    <div class="rounded-[14px] bg-mega-soft p-4 md:col-span-2">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Address for Installation</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->installation_address }}</p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Suburb</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->suburb }}</p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Postcode</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->postcode }}</p>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Type of Job</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach($quoteRequest->job_type as $item)
                                <span class="rounded-full bg-white px-3 py-1 text-sm font-semibold text-mega-black">
                                    {{ ucfirst($item) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Hear From</p>
                        <p class="mt-2 font-semibold text-mega-black">{{ $quoteRequest->local_store }}</p>
                    </div>
                </div>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Product and room details</p>
                <h2 class="text-2xl text-mega-black">Customer Requirements</h2>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Rooms / Areas</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach($quoteRequest->rooms as $room)
                                <span class="rounded-full bg-white px-3 py-1 text-sm font-semibold text-mega-black">
                                    {{ $room }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Interested Products</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach($quoteRequest->products as $product)
                                <span class="rounded-full bg-white px-3 py-1 text-sm font-semibold text-mega-black">
                                    {{ $product }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[14px] bg-mega-soft p-4 md:col-span-2">
                        <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Suitable Days</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach($quoteRequest->suitable_days as $day)
                                <span class="rounded-full bg-white px-3 py-1 text-sm font-semibold text-mega-black">
                                    {{ $day }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="rounded-[18px] border border-mega-line bg-white p-5 shadow-sm">
                            <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Additional Comments</p>
                                    <h3 class="mt-2 text-xl font-black text-mega-black">
                                        Quote Notes & Selected Products
                                    </h3>
                                </div>

                                @if(count($selectedQuoteProducts))
                                    <span class="w-fit rounded-full bg-mega-orange px-3 py-1 text-xs font-black text-white">
                                        {{ count($selectedQuoteProducts) }} {{ count($selectedQuoteProducts) === 1 ? 'product' : 'products' }}
                                    </span>
                                @endif
                            </div>

                            @if(count($selectedQuoteProducts))
                                <div class="space-y-4">
                                    @foreach($selectedQuoteProducts as $index => $item)
                                        <div class="rounded-[14px] border border-orange-100 bg-orange-50/35 p-4">
                                            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-start">
                                                <div class="min-w-0">
                                                    <div class="mb-3 flex flex-wrap items-center gap-2">
                                                        <span class="rounded-full bg-mega-orange/10 px-3 py-1 text-[11px] font-black uppercase tracking-[0.14em] text-mega-orange">
                                                            Product {{ $index + 1 }}
                                                        </span>

                                                        @if(!empty($item['category']))
                                                            <span class="rounded-full bg-white px-3 py-1 text-[11px] font-black uppercase tracking-[0.14em] text-mega-muted">
                                                                {{ $item['category'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <h4 class="text-lg font-black leading-tight text-mega-black">
                                                        {{ $item['name'] }}
                                                    </h4>

                                                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                                        @if(!empty($item['type']))
                                                            <div class="rounded-[12px] bg-white p-3">
                                                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">Type</p>
                                                                <p class="mt-1 text-sm font-bold text-mega-black">{{ $item['type'] }}</p>
                                                            </div>
                                                        @endif

                                                        @if(!empty($item['size']))
                                                            <div class="rounded-[12px] bg-white p-3">
                                                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">Size / Area</p>
                                                                <p class="mt-1 text-sm font-bold text-mega-black">{{ $item['size'] }}</p>
                                                            </div>
                                                        @endif

                                                        @if(!empty($item['area']))
                                                            <div class="rounded-[12px] bg-white p-3">
                                                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">Area</p>
                                                                <p class="mt-1 text-sm font-bold text-mega-black">{{ $item['area'] }}</p>
                                                            </div>
                                                        @endif

                                                        @if(!empty($item['quantity']))
                                                            <div class="rounded-[12px] bg-white p-3">
                                                                <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">Quantity</p>
                                                                <p class="mt-1 text-sm font-bold text-mega-black">{{ $item['quantity'] }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if(!empty($item['estimate']))
                                                    <div class="shrink-0 rounded-[14px] bg-white px-5 py-4 text-left md:text-right">
                                                        <p class="text-[10px] font-black uppercase tracking-[0.16em] text-mega-muted">
                                                            Rough estimate
                                                        </p>

                                                        <p class="mt-1 text-2xl font-black text-mega-black">
                                                            {{ $item['estimate'] }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($quoteProductNote)
                                    <div class="mt-4 rounded-[14px] border border-yellow-200 bg-yellow-50 px-4 py-3">
                                        <p class="text-sm font-semibold leading-6 text-yellow-900">
                                            {{ $quoteProductNote }}
                                        </p>
                                    </div>
                                @endif
                            @endif

                            @if($customerComment)
                                <div class="{{ count($selectedQuoteProducts) ? 'mt-5' : '' }} rounded-[14px] bg-mega-soft p-4">
                                    <p class="text-xs uppercase tracking-[0.16em] text-mega-muted">Customer Note</p>
                                    <p class="mt-2 whitespace-pre-line leading-7 text-mega-black">
                                        {{ $customerComment }}
                                    </p>
                                </div>
                            @endif

                            @if(!count($selectedQuoteProducts) && !$customerComment)
                                <p class="rounded-[14px] bg-mega-soft p-4 text-sm font-semibold text-mega-muted">
                                    No additional comments provided.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="clean-card bg-mega-black p-6 text-white">
                <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                    Request status
                </p>

                <h2 class="mt-4 text-2xl text-white">
                    Manage this lead
                </h2>

                <form method="POST" action="{{ route('admin.quote-requests.status', $quoteRequest) }}" class="mt-6">
                    @csrf
                    @method('PATCH')

                    <label class="mb-2 block text-sm font-medium text-white/70">
                        Update status
                    </label>

                    <select name="status"
                        class="w-full border border-white/10 bg-white/10 px-4 py-3 text-sm text-white outline-none radius-7">
                        <option class="text-black" value="new" @selected($quoteRequest->status === 'new')>New</option>
                        <option class="text-black" value="contacted" @selected($quoteRequest->status === 'contacted')>
                            Contacted
                        </option>
                        <option class="text-black" value="booked" @selected($quoteRequest->status === 'booked')>
                            Booked
                        </option>
                        <option class="text-black" value="completed" @selected($quoteRequest->status === 'completed')>
                            Completed
                        </option>
                        <option class="text-black" value="archived" @selected($quoteRequest->status === 'archived')>
                            Archived
                        </option>
                    </select>

                    <button type="submit"
                        class="mt-4 w-full rounded-[12px] bg-mega-orange px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                        Save status
                    </button>
                </form>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">Quick actions</p>

                <div class="mt-4 grid gap-3">
                    <a href="tel:{{ $quoteRequest->phone }}"
                        class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                        Call customer
                        <span>→</span>
                    </a>

                    <a href="mailto:{{ $quoteRequest->email }}"
                        class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                        Email customer
                        <span>→</span>
                    </a>

                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($quoteRequest->installation_address . ' ' . $quoteRequest->suburb . ' ' . $quoteRequest->postcode) }}"
                        target="_blank"
                        class="flex items-center justify-between border border-mega-line bg-white px-4 py-3 text-sm font-medium text-mega-text transition hover:border-mega-orange hover:text-mega-orange radius-7">
                        Open address
                        <span>→</span>
                    </a>
                </div>
            </div>

            <div class="clean-card bg-white p-6">
                <p class="section-label mb-2">System information</p>

                <div class="mt-4 space-y-4 text-sm">
                    <div>
                        <p class="text-mega-muted">IP Address</p>
                        <p class="mt-1 font-medium text-mega-black">{{ $quoteRequest->ip_address ?: 'Not available' }}</p>
                    </div>

                    <div>
                        <p class="text-mega-muted">Read Status</p>
                        <p class="mt-1 font-medium text-mega-black">
                            {{ $quoteRequest->read_at ? 'Read on ' . $quoteRequest->read_at->format('d M Y, h:i A') : 'Unread' }}
                        </p>
                    </div>
                </div>
            </div>
        </aside>
    </div>

@endsection