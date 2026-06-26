@extends('layouts.admin')

@section('title', 'Website Settings | Mega Carpets Admin')
@section('page_title', 'Website Settings')

@section('content')

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if(session('success'))
            <div class="mb-6 rounded-[14px] border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-[14px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                <p class="font-semibold">Please fix the following errors:</p>
                <ul class="mt-2 list-inside list-disc">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Branding</p>
                    <h2 class="text-2xl text-mega-black">Website Identity</h2>

                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Website Name *</label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}"
                                class="input-clean" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Tagline</label>
                            <input type="text" name="site_tagline"
                                value="{{ old('site_tagline', $settings['site_tagline']) }}" class="input-clean">
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Default Meta Title</label>
                            <input type="text" name="default_meta_title"
                                value="{{ old('default_meta_title', $settings['default_meta_title']) }}"
                                class="input-clean">
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Default Meta Description</label>
                            <textarea name="default_meta_description" rows="3"
                                class="input-clean">{{ old('default_meta_description', $settings['default_meta_description']) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Header</p>
                    <h2 class="text-2xl text-mega-black">Topbar & Contact Buttons</h2>

                    <div class="mt-6 grid gap-5 md:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Topbar Left</label>
                            <input type="text" name="topbar_left" value="{{ old('topbar_left', $settings['topbar_left']) }}"
                                class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Topbar Middle</label>
                            <input type="text" name="topbar_middle"
                                value="{{ old('topbar_middle', $settings['topbar_middle']) }}" class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Topbar Right</label>
                            <input type="text" name="topbar_right"
                                value="{{ old('topbar_right', $settings['topbar_right']) }}" class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Consultation Button Text</label>
                            <input type="text" name="consultation_button_text"
                                value="{{ old('consultation_button_text', $settings['consultation_button_text']) }}"
                                class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Phone Display</label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $settings['phone_number']) }}" class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Phone Link</label>
                            <input type="text" name="phone_link" value="{{ old('phone_link', $settings['phone_link']) }}"
                                class="input-clean">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Email</label>
                            <input type="email" name="email" value="{{ old('email', $settings['email']) }}"
                                class="input-clean">
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-mega-text">Address</label>
                            <input type="text" name="address" value="{{ old('address', $settings['address']) }}"
                                class="input-clean">
                        </div>
                    </div>

                    <div class="mt-6 grid gap-3 md:grid-cols-3">
                        <label
                            class="flex items-center gap-2 rounded-[14px] border border-mega-line bg-mega-soft p-4 text-sm font-semibold">
                            <input type="checkbox" name="show_header_admin_login" value="1"
                                @checked(old('show_header_admin_login', $settings['show_header_admin_login']) == '1')>
                            Show Admin Login Icon
                        </label>

                        <label
                            class="flex items-center gap-2 rounded-[14px] border border-mega-line bg-mega-soft p-4 text-sm font-semibold">
                            <input type="checkbox" name="show_wishlist_button" value="1"
                                @checked(old('show_wishlist_button', $settings['show_wishlist_button']) == '1')>
                            Show Wishlist Button
                        </label>

                        <label
                            class="flex items-center gap-2 rounded-[14px] border border-mega-line bg-mega-soft p-4 text-sm font-semibold">
                            <input type="checkbox" name="show_quote_button" value="1" @checked(old('show_quote_button', $settings['show_quote_button']) == '1')>
                            Show Quote Button
                        </label>
                    </div>
                </div>

                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Footer</p>
                    <h2 class="text-2xl text-mega-black">Footer Content</h2>

                    <div class="mt-6 grid gap-5">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Footer Description</label>
                            <textarea name="footer_description" rows="4"
                                class="input-clean">{{ old('footer_description', $settings['footer_description']) }}</textarea>
                        </div>

                        {{-- <div class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-mega-text">Copyright Text</label>
                                <input type="text" name="footer_copyright"
                                    value="{{ old('footer_copyright', $settings['footer_copyright']) }}"
                                    class="input-clean">
                                <p class="mt-1 text-xs text-mega-muted">Use {year} to show current year.</p>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-mega-text">Footer Credit</label>
                                <input type="text" name="footer_credit"
                                    value="{{ old('footer_credit', $settings['footer_credit']) }}" class="input-clean">
                            </div>
                        </div> --}}

                        {{-- <div class="grid gap-5 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-mega-text">Column 1 Title</label>
                                <input type="text" name="footer_help_title"
                                    value="{{ old('footer_help_title', $settings['footer_help_title']) }}"
                                    class="input-clean">

                                <label class="mb-2 mt-4 block text-sm font-medium text-mega-text">Column 1 Links</label>
                                <textarea name="footer_help_links" rows="7"
                                    class="input-clean font-mono text-sm">{{ old('footer_help_links', $settings['footer_help_links']) }}</textarea>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-mega-text">Column 2 Title</label>
                                <input type="text" name="footer_company_title"
                                    value="{{ old('footer_company_title', $settings['footer_company_title']) }}"
                                    class="input-clean">

                                <label class="mb-2 mt-4 block text-sm font-medium text-mega-text">Column 2 Links</label>
                                <textarea name="footer_company_links" rows="7"
                                    class="input-clean font-mono text-sm">{{ old('footer_company_links', $settings['footer_company_links']) }}</textarea>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-mega-text">Column 3 Title</label>
                                <input type="text" name="footer_touch_title"
                                    value="{{ old('footer_touch_title', $settings['footer_touch_title']) }}"
                                    class="input-clean">

                                <label class="mb-2 mt-4 block text-sm font-medium text-mega-text">Column 3 Links</label>
                                <textarea name="footer_touch_links" rows="7"
                                    class="input-clean font-mono text-sm">{{ old('footer_touch_links', $settings['footer_touch_links']) }}</textarea>
                            </div>
                        </div> --}}

                        {{-- <div class="rounded-[14px] border border-mega-line bg-mega-soft p-4 text-sm text-mega-muted">
                            Link format: <strong>Label|URL</strong>, one item per line. Example: <strong>Book
                                Quote|/free-measure-quote</strong>
                        </div> --}}
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Logo Files</p>

                    <div class="space-y-5">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Header Logo</label>

                            @if(!empty($settings['site_logo']))
                                <div class="mb-3 rounded-[14px] border border-mega-line bg-mega-soft p-3">
                                    <img src="{{ \App\Models\SiteSetting::imageUrl($settings['site_logo']) }}" alt="Header logo"
                                        class="h-20 w-full object-contain">
                                </div>
                            @endif

                            <input type="file" name="site_logo_file" accept="image/jpeg,image/png,image/webp"
                                class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Footer Logo</label>

                            @if(!empty($settings['footer_logo']))
                                <div class="mb-3 rounded-[14px] border border-mega-line bg-mega-soft p-3">
                                    <img src="{{ \App\Models\SiteSetting::imageUrl($settings['footer_logo']) }}"
                                        alt="Footer logo" class="h-20 w-full object-contain">
                                </div>
                            @endif

                            <input type="file" name="footer_logo_file" accept="image/jpeg,image/png,image/webp"
                                class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-mega-text">Favicon</label>
                            <input type="file" name="favicon_file" accept="image/jpeg,image/png,image/webp,image/x-icon"
                                class="block w-full rounded-[14px] border border-mega-line bg-white p-3 text-sm">
                        </div>
                    </div>
                </div>

                {{-- <div class="clean-card bg-white p-6">
                    <p class="section-label mb-2">Social Links</p>

                    <div class="space-y-4">
                        <input type="text" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}"
                            class="input-clean" placeholder="Facebook URL">
                        <input type="text" name="instagram_url"
                            value="{{ old('instagram_url', $settings['instagram_url']) }}" class="input-clean"
                            placeholder="Instagram URL">
                        <input type="text" name="pinterest_url"
                            value="{{ old('pinterest_url', $settings['pinterest_url']) }}" class="input-clean"
                            placeholder="Pinterest URL">
                        <input type="text" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}"
                            class="input-clean" placeholder="YouTube URL">

                        <label
                            class="flex items-center gap-2 rounded-[14px] border border-mega-line bg-mega-soft p-4 text-sm font-semibold">
                            <input type="checkbox" name="show_footer_socials" value="1" @checked(old('show_footer_socials',
                                $settings['show_footer_socials'])=='1' )>
                            Show footer social buttons
                        </label>
                    </div>
                </div> --}}

                <div class="clean-card bg-mega-black p-6 text-white">
                    <p class="text-xs font-medium uppercase tracking-[0.22em] text-mega-orange">
                        Save changes
                    </p>

                    <h2 class="mt-3 text-2xl text-white">
                        Update website settings
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-white/60">
                        These settings control header, footer, branding, SEO defaults, phone, email and social links.
                    </p>

                    <button type="submit"
                        class="mt-6 w-full rounded-[12px] bg-mega-orange px-4 py-4 text-sm font-bold text-white transition hover:bg-orange-600">
                        Save Settings
                    </button>
                </div>
            </aside>
        </div>
    </form>

@endsection