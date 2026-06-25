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
        $promo = new SpecialPromo();

        return view('admin.special-promos.create', compact('promo'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePromo($request, true);

        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('specials', 'public');
        }

        unset($validated['image_file']);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

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

        if ($request->hasFile('image_file')) {
            $this->deleteStoredFile($specialPromo->image);
            $validated['image'] = $request->file('image_file')->store('specials', 'public');
        } else {
            $validated['image'] = $specialPromo->image;
        }

        unset($validated['image_file']);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

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
            'image_file' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
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