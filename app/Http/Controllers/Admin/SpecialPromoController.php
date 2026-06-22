<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialPromo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SpecialPromoController extends Controller
{
    public function index(): View
    {
        $promos = SpecialPromo::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.special-promos.index', compact('promos'));
    }

    public function create(): View
    {
        if (SpecialPromo::count() >= 3) {
            abort(403, 'Only 3 special promo slides are allowed. Please edit or delete an existing slide.');
        }

        $promo = new SpecialPromo();

        return view('admin.special-promos.create', compact('promo'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (SpecialPromo::count() >= 3) {
            return back()->with('error', 'Only 3 special promo slides are allowed.');
        }

        $validated = $this->validatePromo($request, true);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('specials', 'public');
        }

        SpecialPromo::create($validated);

        return redirect()
            ->route('admin.special-promos.index')
            ->with('success', 'Special promo created successfully.');
    }

    public function edit(SpecialPromo $specialPromo): View
    {
        $promo = $specialPromo;

        return view('admin.special-promos.edit', compact('promo'));
    }

    public function update(Request $request, SpecialPromo $specialPromo): RedirectResponse
    {
        $validated = $this->validatePromo($request, false);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $this->deleteStoredFile($specialPromo->image);
            $validated['image'] = $request->file('image_file')->store('specials', 'public');
        } else {
            $validated['image'] = $specialPromo->image;
        }

        $specialPromo->update($validated);

        return redirect()
            ->route('admin.special-promos.index')
            ->with('success', 'Special promo updated successfully.');
    }

    public function destroy(SpecialPromo $specialPromo): RedirectResponse
    {
        $this->deleteStoredFile($specialPromo->image);

        $specialPromo->delete();

        return back()->with('success', 'Special promo deleted successfully.');
    }

    private function validatePromo(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:190'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'image_file' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'button_text' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function deleteStoredFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/storage/', 'storage/', '/images/', 'images/'])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}