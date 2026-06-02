<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Mega Carpets</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-mega-cream">
    <section class="grid min-h-screen lg:grid-cols-[0.95fr_1.05fr]">
        <div class="relative hidden overflow-hidden bg-mega-black lg:block">
            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1600&q=80"
                alt="Mega Carpets admin" class="h-full w-full object-cover opacity-35">

            <div class="absolute inset-0 bg-gradient-to-br from-mega-black via-mega-black/80 to-mega-black/40"></div>

            <div class="absolute inset-x-0 bottom-0 p-12">
                <div class="max-w-lg">
                    <div class="mb-6 flex h-14 w-[110px] items-center justify-center bg-white radius-7">
                        <div class="text-center leading-none">
                            <div class="-skew-x-12 font-heading text-xl font-medium tracking-tight text-mega-orange">
                                MEGA
                            </div>
                            <div class="text-[10px] font-medium uppercase tracking-[0.24em] text-mega-black">
                                Carpets
                            </div>
                        </div>
                    </div>

                    <p class="text-xs font-medium uppercase tracking-[0.24em] text-mega-orange">
                        Admin panel
                    </p>

                    <h1 class="mt-4 text-5xl leading-tight text-white">
                        Manage products, quotes and showroom content.
                    </h1>

                    <p class="mt-5 text-base leading-7 text-white/60">
                        Secure admin access for managing Mega Carpets frontend content and future lead requests.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-10">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden">
                    <div class="flex h-14 w-[110px] items-center justify-center bg-mega-black radius-7">
                        <div class="text-center leading-none">
                            <div class="-skew-x-12 font-heading text-xl font-medium tracking-tight text-mega-orange">
                                MEGA
                            </div>
                            <div class="text-[10px] font-medium uppercase tracking-[0.24em] text-white">
                                Carpets
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clean-card bg-white p-6 md:p-8">
                    <div>
                        <p class="section-label mb-3">
                            Admin login
                        </p>

                        <h2 class="text-3xl leading-tight text-mega-black">
                            Welcome back
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-mega-muted">
                            Sign in to continue to the Mega Carpets admin panel.
                        </p>
                    </div>

                    @if(session('error'))
                        <div class="mt-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 radius-7">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mt-5 border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 radius-7">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 radius-7">
                            Please check your email and password.
                        </div>
                    @endif

                    <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-6">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-mega-text">
                                Email address
                            </label>

                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="input-clean"
                                placeholder="admin@megacarpets.com" required autofocus>

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="password" class="mb-2 block text-sm font-medium text-mega-text">
                                Password
                            </label>

                            <input id="password" type="password" name="password" class="input-clean"
                                placeholder="Enter password" required>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5 flex items-center justify-between gap-4">
                            <label class="flex items-center gap-2 text-sm text-mega-muted">
                                <input type="checkbox" name="remember" value="1"
                                    class="h-4 w-4 rounded border-mega-line text-mega-orange focus:ring-mega-orange">
                                Remember me
                            </label>

                            <a href="{{ route('frontend.home') }}" class="text-sm font-medium text-mega-orange">
                                Back to website
                            </a>
                        </div>

                        <button type="submit" class="btn-primary mt-6 w-full">
                            Login to admin panel
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M5 12h14" />
                                <path d="M13 6l6 6-6 6" />
                            </svg>
                        </button>
                    </form>

                    <div
                        class="mt-6 border border-mega-line bg-mega-soft p-4 text-sm leading-6 text-mega-muted radius-7">
                        <p class="font-medium text-mega-black">Demo credential</p>
                        <p class="mt-1">Email: admin@megacarpets.com</p>
                        <p>Password: Admin@12345</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>