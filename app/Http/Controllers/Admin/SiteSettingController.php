<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::frontend();

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:190'],
            'site_tagline' => ['nullable', 'string', 'max:190'],

            'site_logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'footer_logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'favicon_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,ico', 'max:2048'],

            'default_meta_title' => ['nullable', 'string', 'max:190'],
            'default_meta_description' => ['nullable', 'string', 'max:500'],

            'topbar_left' => ['nullable', 'string', 'max:190'],
            'topbar_middle' => ['nullable', 'string', 'max:190'],
            'topbar_right' => ['nullable', 'string', 'max:190'],

            'consultation_button_text' => ['nullable', 'string', 'max:120'],
            'phone_number' => ['nullable', 'string', 'max:80'],
            'phone_link' => ['nullable', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:190'],
            'address' => ['nullable', 'string', 'max:500'],

            'footer_description' => ['nullable', 'string', 'max:1000'],
            'footer_copyright' => ['nullable', 'string', 'max:300'],
            'footer_credit' => ['nullable', 'string', 'max:300'],

            'footer_help_title' => ['nullable', 'string', 'max:120'],
            'footer_help_links' => ['nullable', 'string', 'max:5000'],

            'footer_company_title' => ['nullable', 'string', 'max:120'],
            'footer_company_links' => ['nullable', 'string', 'max:5000'],

            'footer_touch_title' => ['nullable', 'string', 'max:120'],
            'footer_touch_links' => ['nullable', 'string', 'max:5000'],

            'facebook_url' => ['nullable', 'string', 'max:500'],
            'instagram_url' => ['nullable', 'string', 'max:500'],
            'pinterest_url' => ['nullable', 'string', 'max:500'],
            'youtube_url' => ['nullable', 'string', 'max:500'],

            'show_header_admin_login' => ['nullable', 'boolean'],
            'show_wishlist_button' => ['nullable', 'boolean'],
            'show_quote_button' => ['nullable', 'boolean'],
            'show_footer_socials' => ['nullable', 'boolean'],
        ]);

        $groups = [
            'site_name' => 'branding',
            'site_tagline' => 'branding',
            'default_meta_title' => 'seo',
            'default_meta_description' => 'seo',

            'topbar_left' => 'header',
            'topbar_middle' => 'header',
            'topbar_right' => 'header',
            'consultation_button_text' => 'header',

            'phone_number' => 'contact',
            'phone_link' => 'contact',
            'email' => 'contact',
            'address' => 'contact',

            'footer_description' => 'footer',
            'footer_copyright' => 'footer',
            'footer_credit' => 'footer',
            'footer_help_title' => 'footer',
            'footer_help_links' => 'footer',
            'footer_company_title' => 'footer',
            'footer_company_links' => 'footer',
            'footer_touch_title' => 'footer',
            'footer_touch_links' => 'footer',

            'facebook_url' => 'social',
            'instagram_url' => 'social',
            'pinterest_url' => 'social',
            'youtube_url' => 'social',
        ];

        foreach ($groups as $key => $group) {
            SiteSetting::setValue($key, $validated[$key] ?? '', $group);
        }

        SiteSetting::setValue(
            'show_header_admin_login',
            $request->boolean('show_header_admin_login') ? '1' : '0',
            'header'
        );

        SiteSetting::setValue(
            'show_wishlist_button',
            $request->boolean('show_wishlist_button') ? '1' : '0',
            'header'
        );

        SiteSetting::setValue(
            'show_quote_button',
            $request->boolean('show_quote_button') ? '1' : '0',
            'header'
        );

        SiteSetting::setValue(
            'show_footer_socials',
            $request->boolean('show_footer_socials') ? '1' : '0',
            'footer'
        );

        $current = SiteSetting::frontend();

        if ($request->hasFile('site_logo_file')) {
            $this->deleteStoredFile($current['site_logo'] ?? null);

            SiteSetting::setValue(
                'site_logo',
                $request->file('site_logo_file')->store('settings', 'public'),
                'branding'
            );
        }

        if ($request->hasFile('footer_logo_file')) {
            $this->deleteStoredFile($current['footer_logo'] ?? null);

            SiteSetting::setValue(
                'footer_logo',
                $request->file('footer_logo_file')->store('settings', 'public'),
                'footer'
            );
        }

        if ($request->hasFile('favicon_file')) {
            $this->deleteStoredFile($current['favicon'] ?? null);

            SiteSetting::setValue(
                'favicon',
                $request->file('favicon_file')->store('settings', 'public'),
                'branding'
            );
        }

        return back()->with('success', 'Website settings updated successfully.');
    }

    private function deleteStoredFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Str::startsWith($path, [
            'http://',
            'https://',
            '/images/',
            'images/',
            '/favicon',
            'favicon',
            '/storage/',
            'storage/',
        ])) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}