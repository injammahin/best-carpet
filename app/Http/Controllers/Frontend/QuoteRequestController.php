<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:80'],
            'company' => ['nullable', 'string', 'max:190'],

            'preferred_contact' => ['nullable', 'array'],
            'preferred_contact.*' => ['nullable', 'string', 'max:50'],

            'subscribe' => ['nullable', 'boolean'],

            'job_type' => ['required', 'array', 'min:1'],
            'job_type.*' => ['required', 'string', 'max:80'],

            'installation_address' => ['required', 'string', 'max:1000'],
            'suburb' => ['required', 'string', 'max:150'],
            'postcode' => ['required', 'string', 'max:30'],

            'rooms' => ['required', 'array', 'min:1'],
            'rooms.*' => ['required', 'string', 'max:120'],

            'products' => ['required', 'array', 'min:1'],
            'products.*' => ['required', 'string', 'max:120'],

            'suitable_days' => ['required', 'array', 'min:1'],
            'suitable_days.*' => ['required', 'string', 'max:60'],

            'local_store' => ['required', 'string', 'max:190'],
            'comments' => ['nullable', 'string', 'max:5000'],
        ]);

        QuoteRequest::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,

            'preferred_contact' => $validated['preferred_contact'] ?? [],
            'subscribe' => $request->boolean('subscribe'),

            'job_type' => $validated['job_type'],
            'installation_address' => $validated['installation_address'],
            'suburb' => $validated['suburb'],
            'postcode' => $validated['postcode'],

            'rooms' => $validated['rooms'],
            'products' => $validated['products'],
            'suitable_days' => $validated['suitable_days'],

            'local_store' => $validated['local_store'],
            'comments' => $validated['comments'] ?? null,

            'status' => 'new',
            'read_at' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->back()
            ->with('quote_success', 'Thank you. Your free measure and quote request has been submitted successfully.');
    }

    public function quickStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:190'],
            'phone' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:190'],
            'product_category' => ['required', 'string', 'max:120'],
            'room' => ['required', 'string', 'max:120'],
            'approximate_size' => ['nullable', 'string', 'max:190'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        $nameParts = preg_split('/\s+/', trim($validated['full_name']), 2);

        $firstName = $nameParts[0] ?? $validated['full_name'];
        $lastName = $nameParts[1] ?? 'Not provided';

        $jobType = strtolower($validated['room']) === 'commercial space'
            ? ['commercial']
            : ['residential'];

        $comments = trim(
            "Quick quote / contact enquiry" .
            "\n\nProduct category: " . $validated['product_category'] .
            "\nRoom: " . $validated['room'] .
            "\nApprox room size: " . ($validated['approximate_size'] ?? 'Not provided') .
            "\n\nProject details: " . ($validated['message'] ?? 'Not provided')
        );

        QuoteRequest::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => null,

            'preferred_contact' => ['email', 'phone'],
            'subscribe' => false,

            'job_type' => $jobType,
            'installation_address' => 'Not provided from quick quote / contact form',
            'suburb' => 'Not provided',
            'postcode' => 'Not provided',

            'rooms' => [$validated['room']],
            'products' => [$validated['product_category']],
            'suitable_days' => ['Not provided'],

            'local_store' => 'Mega Carpets',
            'comments' => $comments,

            'status' => 'new',
            'read_at' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->back()
            ->with('quick_quote_success', 'Thank you. Your enquiry has been submitted successfully.');
    }
}