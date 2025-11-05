<!DOCTYPE html>
<html lang="@lang('en')">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ Vite::asset('resources/images/favicon.png') }}" type="image/png">
        <meta property="og:url" content="https://monitor.cantagalo.it">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Laravel Monitor - @yield('title')">
        <meta property="og:description" content="@yield('description')">
        <meta property="og:image" content="{{ Vite::asset('resources/images/og.jpg') }}">
        <meta name="csrf-token" content="{{ csrf_token(); }}">
        <title>Laravel Monitor - @yield('title')</title>
        <script>window.AppData = { cookiePermission: @json(session('permission', false)) };</script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="flex flex-wrap justify-between items-center px-6 py-4 bg-white shadow">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 max-w-[250px] sm:max-w-none">
                Laravel Monitor
            </h1>
            <p class="text lg:mr-[35vw] text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 max-w-[250px] sm:max-w-none">
                <span class="text__first">
                    <span class="text__word">
                        - @lang('CRM / Access Monitor')
                    </span>
                    <span class="text__first-bg"></span>
                </span>
                <br>
                <span class="text__second">
                    <span class="text__word">
                        - @lang('Anti-scraping tools')
                    </span>
                    <span class="text__second-bg"></span>
                </span>
            </p>
            @include('partials.lang-switcher', ['option' => 0, 'lang' => session('lang')])
        </header>
        @yield('main')
        <footer class="w-full py-4 bg-gray-100 text-center text-sm text-gray-600">
            <a href="{{ route('monitor.legal') }}" target="_blank" 
            class="hover:text-gray-800 hover:font-medium transition">
                @lang('Terms of use and privacy policy')
            </a>
        </footer>
    </body>
</html>
