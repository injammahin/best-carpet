<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuoteRequestController extends Controller
{
    public function index(Request $request): View
    {
        $query = QuoteRequest::query()->latest();

        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'unread') {
                $query->whereNull('read_at');
            } else {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('suburb', 'like', "%{$search}%")
                    ->orWhere('postcode', 'like', "%{$search}%")
                    ->orWhere('local_store', 'like', "%{$search}%");
            });
        }

        // Use appends() to preserve query string parameters on pagination
        $quoteRequests = $query->paginate(12)->appends($request->query());

        $stats = [
            'total' => QuoteRequest::count(),
            'unread' => QuoteRequest::whereNull('read_at')->count(),
            'today' => QuoteRequest::whereDate('created_at', today())->count(),
            'booked' => QuoteRequest::where('status', 'booked')->count(),
        ];

        return view('admin.quote-requests.index', compact('quoteRequests', 'stats'));
    }

    public function show(QuoteRequest $quoteRequest): View
    {
        if (is_null($quoteRequest->read_at)) {
            $quoteRequest->update([
                'read_at' => now(),
            ]);
        }

        return view('admin.quote-requests.show', compact('quoteRequest'));
    }

    public function updateStatus(Request $request, QuoteRequest $quoteRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,contacted,booked,completed,archived'],
        ]);

        $quoteRequest->update($validated);

        return back()->with('success', 'Quote request status updated successfully.');
    }

    public function markUnread(QuoteRequest $quoteRequest): RedirectResponse
    {
        $quoteRequest->update([
            'read_at' => null,
        ]);

        return back()->with('success', 'Quote request marked as unread.');
    }

    public function destroy(QuoteRequest $quoteRequest): RedirectResponse
    {
        $quoteRequest->delete();

        return redirect()
            ->route('admin.quote-requests.index')
            ->with('success', 'Quote request deleted successfully.');
    }
}