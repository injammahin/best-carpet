<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageSettingController extends Controller
{
    public function edit(): View
    {
        $homeSetting = HomePageSetting::query()->firstOrCreate([], HomePageSetting::defaultData());

        return view('admin.home-settings.edit', compact('homeSetting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_side_image_one_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'hero_side_image_two_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'visualizer_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'shop_room_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'quote_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'hero_slides' => ['nullable', 'array'],
            'hero_slides.*.eyebrow' => ['nullable', 'string', 'max:180'],
            'hero_slides.*.title' => ['nullable', 'string', 'max:255'],
            'hero_slides.*.text' => ['nullable', 'string', 'max:1000'],
            'hero_slides.*.image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'recent_work_concepts' => ['nullable', 'array'],
            'recent_work_concepts.*.title' => ['nullable', 'string', 'max:255'],
            'recent_work_concepts.*.type' => ['nullable', 'string', 'max:255'],
            'recent_work_concepts.*.location' => ['nullable', 'string', 'max:255'],
            'recent_work_concepts.*.image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'shop_room_items' => ['nullable', 'array'],
            'shop_room_items.*.type' => ['nullable', 'string', 'max:255'],
            'shop_room_items.*.name' => ['nullable', 'string', 'max:255'],
            'shop_room_items.*.color' => ['nullable', 'string', 'max:20'],
        ]);

        $homeSetting = HomePageSetting::query()->firstOrCreate([], HomePageSetting::defaultData());

        $homeSetting->hero_side_image_one = $this->storeSingleImage(
            $request,
            'hero_side_image_one_file',
            $request->input('hero_side_image_one_existing')
        );

        $homeSetting->hero_side_image_two = $this->storeSingleImage(
            $request,
            'hero_side_image_two_file',
            $request->input('hero_side_image_two_existing')
        );

        $homeSetting->hero_card_kicker = $request->input('hero_card_kicker');
        $homeSetting->hero_card_text = $request->input('hero_card_text');
        $homeSetting->hero_slides = $this->prepareHeroSlides($request);

        $homeSetting->visualizer_image = $this->storeSingleImage(
            $request,
            'visualizer_image_file',
            $request->input('visualizer_image_existing')
        );

        $homeSetting->visualizer_kicker = $request->input('visualizer_kicker');
        $homeSetting->visualizer_title = $request->input('visualizer_title');
        $homeSetting->visualizer_text = $request->input('visualizer_text');
        $homeSetting->visualizer_features = $this->prepareLines($request->input('visualizer_features_text'));

        $homeSetting->shop_room_image = $this->storeSingleImage(
            $request,
            'shop_room_image_file',
            $request->input('shop_room_image_existing')
        );

        $homeSetting->shop_room_kicker = $request->input('shop_room_kicker');
        $homeSetting->shop_room_title = $request->input('shop_room_title');
        $homeSetting->shop_room_text = $request->input('shop_room_text');
        $homeSetting->shop_room_items = $this->prepareShopRoomItems($request);

        $homeSetting->recent_work_concepts = $this->prepareRecentWork($request);

        $homeSetting->quote_image = $this->storeSingleImage(
            $request,
            'quote_image_file',
            $request->input('quote_image_existing')
        );

        $homeSetting->quote_kicker = $request->input('quote_kicker');
        $homeSetting->quote_title = $request->input('quote_title');
        $homeSetting->quote_text = $request->input('quote_text');
        $homeSetting->quote_phone = $request->input('quote_phone');

        $homeSetting->save();

        return redirect()
            ->route('admin.home-settings.edit')
            ->with('success', 'Home page settings updated successfully.');
    }

    private function storeSingleImage(Request $request, string $inputName, ?string $existingPath): ?string
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store('home-page', 'public');
        }

        return $existingPath;
    }

    private function storeRepeaterImage(Request $request, string $inputName, ?string $existingPath): ?string
    {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store('home-page', 'public');
        }

        return $existingPath;
    }

    private function prepareHeroSlides(Request $request): array
    {
        $slides = [];

        foreach ((array) $request->input('hero_slides', []) as $index => $slide) {
            $imagePath = $this->storeRepeaterImage(
                $request,
                "hero_slides.$index.image_file",
                $slide['image_existing'] ?? null
            );

            if (
                empty($slide['eyebrow']) &&
                empty($slide['title']) &&
                empty($slide['text']) &&
                empty($imagePath)
            ) {
                continue;
            }

            $slides[] = [
                'eyebrow' => $slide['eyebrow'] ?? '',
                'title' => $slide['title'] ?? '',
                'text' => $slide['text'] ?? '',
                'image' => $imagePath,
            ];
        }

        return $slides ?: HomePageSetting::defaultHeroSlides();
    }

    private function prepareRecentWork(Request $request): array
    {
        $items = [];

        foreach ((array) $request->input('recent_work_concepts', []) as $index => $item) {
            $imagePath = $this->storeRepeaterImage(
                $request,
                "recent_work_concepts.$index.image_file",
                $item['image_existing'] ?? null
            );

            if (
                empty($item['title']) &&
                empty($item['type']) &&
                empty($item['location']) &&
                empty($imagePath)
            ) {
                continue;
            }

            $items[] = [
                'title' => $item['title'] ?? '',
                'type' => $item['type'] ?? '',
                'location' => $item['location'] ?? '',
                'image' => $imagePath,
            ];
        }

        return $items ?: HomePageSetting::defaultRecentWork();
    }

    private function prepareShopRoomItems(Request $request): array
    {
        $items = [];

        foreach ((array) $request->input('shop_room_items', []) as $item) {
            if (empty($item['type']) && empty($item['name'])) {
                continue;
            }

            $items[] = [
                'type' => $item['type'] ?? '',
                'name' => $item['name'] ?? '',
                'color' => $item['color'] ?? '#dcd8cd',
            ];
        }

        return $items ?: HomePageSetting::defaultData()['shop_room_items'];
    }

    private function prepareLines(?string $text): array
    {
        return collect(explode("\n", (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}