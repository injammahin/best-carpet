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

    {{--
    Header is fixed, so main needs top padding.
    Desktop header height:
    40px black bar + 82px main header + 58px product nav = 180px

    Mobile/tablet:
    36px black bar + 82px main header = around 118px
    --}}
    <main class="pt-[118px] lg:pt-[180px]">
        @yield('content')
    </main>

    @include('partials.frontend.footer')
</body>

</html>