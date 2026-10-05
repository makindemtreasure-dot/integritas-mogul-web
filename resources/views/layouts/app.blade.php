<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#172b25">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="INTEGRITAS MOGUL COMPANY GLOBAL LTD, connecting trusted Nigerian produce with transparent operations.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
</head>
<body class="min-h-screen antialiased">
    <header class="border-b border-ink/10 bg-paper">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-x-8 gap-y-3 px-5 py-4 sm:px-8">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3" aria-label="INTEGRITAS MOGUL home">
                <img src="{{ asset('images/logo.png') }}" alt="Integritas Mogul logo" class="h-11 w-11 shrink-0 object-contain">
                <span class="min-w-0">
                    <span class="block text-xs font-bold uppercase leading-tight tracking-normal text-ink">INTEGRITAS MOGUL</span>
                    <span class="mt-1 block text-[10px] uppercase leading-tight text-muted">Company Global Ltd</span>
                </span>
            </a>
            <nav aria-label="Main navigation" class="flex items-center gap-2 text-sm sm:gap-6">
                <a href="{{ route('home') }}" @class(['border-b-2 border-citrus px-2 py-2 font-semibold text-ink' => request()->routeIs('home'), 'px-2 py-2 text-muted transition hover:text-ink' => ! request()->routeIs('home')])>Home</a>
                <a href="{{ route('about') }}" @class(['border-b-2 border-citrus px-2 py-2 font-semibold text-ink' => request()->routeIs('about'), 'px-2 py-2 text-muted transition hover:text-ink' => ! request()->routeIs('about')])>About Us</a>
                <a href="{{ route('produce') }}" @class(['border-b-2 border-citrus px-2 py-2 font-semibold text-ink' => request()->routeIs('produce'), 'px-2 py-2 text-muted transition hover:text-ink' => ! request()->routeIs('produce')])>Our Produce</a>
                <a href="{{ route('investors') }}" @class(['border-b-2 border-citrus px-2 py-2 font-semibold text-ink' => request()->routeIs('investors'), 'px-2 py-2 text-muted transition hover:text-ink' => ! request()->routeIs('investors')])>Investors</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 bg-ink text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-5 py-8 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <p class="font-display text-xl">INTEGRITAS MOGUL</p>
                <p class="mt-1 text-sm text-white/65">Grounded in Nigeria. Built for enduring value.</p>
            </div>
            <div class="text-sm text-white/65 sm:text-right">
                <p>Akure &middot; Ifo, Nigeria</p>
                <p class="mt-1">&copy; {{ now()->year }} INTEGRITAS MOGUL COMPANY GLOBAL LTD</p>
            </div>
        </div>
    </footer>
</body>
</html>