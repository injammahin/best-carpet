<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel | Mega Carpets')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-mega-cream text-mega-text">
    <div x-data="{
            sidebarOpen: false,
            sidebarCollapsed: localStorage.getItem('mega_admin_sidebar_collapsed') === '1',
            isDesktop: window.innerWidth >= 1024,

            toggleSidebar() {
                if (this.isDesktop) {
                    this.sidebarCollapsed = !this.sidebarCollapsed;
                    localStorage.setItem('mega_admin_sidebar_collapsed', this.sidebarCollapsed ? '1' : '0');
                } else {
                    this.sidebarOpen = !this.sidebarOpen;
                }
            },

            closeMobileSidebar() {
                if (!this.isDesktop) {
                    this.sidebarOpen = false;
                }
            }
        }" x-init="
            window.addEventListener('resize', () => {
                isDesktop = window.innerWidth >= 1024;

                if (isDesktop) {
                    sidebarOpen = false;
                }
            });
        " @keydown.escape.window="sidebarOpen = false" class="min-h-screen">
        @include('partials.admin.sidebar')

        <div class="min-h-screen transition-all duration-300" :class="sidebarCollapsed ? 'lg:pl-[92px]' : 'lg:pl-72'">
            @include('partials.admin.topbar')

            <main class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>