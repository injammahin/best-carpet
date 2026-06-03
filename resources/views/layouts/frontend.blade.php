<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Mega Carpets | Premium Flooring Showroom')</title>

    <meta name="description"
        content="@yield('meta_description', 'Premium carpet, hybrid, timber, laminate, vinyl and rugs showroom with free measure and quote.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    @include('partials.frontend.header')

    <main>
        @yield('content')
    </main>

    @include('partials.frontend.footer')

    {{-- This must be global so it works on homepage, products page, details page, quote page, contact page --}}
    @include('partials.frontend.global-actions')
</body>

</html>