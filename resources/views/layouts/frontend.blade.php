@php
    use App\Models\SiteSetting;

    try {
        $settings = SiteSetting::frontend();
    } catch (\Throwable $e) {
        $settings = SiteSetting::defaults();
    }

    $siteName = $settings['site_name'] ?? 'Mega Carpets';

    $defaultTitle = $settings['default_meta_title']
        ?? 'Mega Carpets | Premium Flooring Showroom';

    $defaultDescription = $settings['default_meta_description']
        ?? 'Premium carpet, hybrid, timber, laminate, vinyl and rugs showroom with free measure and quote.';

    $pageTitle = trim($__env->yieldContent('title', $defaultTitle));
    $pageDescription = trim($__env->yieldContent('meta_description', $defaultDescription));

    $faviconUrl = SiteSetting::imageUrl($settings['favicon'] ?? null, '/favicon.ico');
    $siteLogoUrl = SiteSetting::imageUrl($settings['site_logo'] ?? null, '/images/logo/mega_logo_3-removebg-preview.webp');

    $currentUrl = request()->url();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $pageTitle }}</title>

    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    @if($siteLogoUrl)
        <meta property="og:image" content="{{ $siteLogoUrl }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">

    @if($siteLogoUrl)
        <meta name="twitter:image" content="{{ $siteLogoUrl }}">
    @endif

    @if($faviconUrl)
        <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
        <link rel="shortcut icon" href="{{ $faviconUrl }}">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
    @endif

    <meta name="theme-color" content="#f58220">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-white">
    @include('partials.frontend.header')

    <main class="site-main">
        @yield('content')
    </main>

    @include('partials.frontend.footer')

    @include('partials.frontend.global-actions')

    @stack('scripts')
</body>

</html>