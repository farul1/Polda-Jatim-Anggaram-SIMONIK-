<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('img/logo_polda.png') }}" type="image/x-icon">
    <title>{{ config('app.name', 'SIMONIK') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Stack Styles (buat Trix dll) --}}
    @stack('styles')
</head>
<body class="font-sans antialiased ">
    <!-- Futuristic Loader -->
    <div class="loader-wrapper">
        <div class="loader-container">
            <div class="holographic-loader">
                <div class="holographic-plane"></div>
                <div class="holographic-grid">
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                </div>
                <div class="loading-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>

                @if(get_setting('logo_kanan'))
                    <img src="{{ Storage::url(get_setting('logo_kanan')) }}" class="holographic-logo" alt="Logo Polri">
                @endif
            </div>
        </div>

        <div class="loader-text">
            <span class="loading-text">Memuat Sistem <strong>{{ get_setting('app_name') ?? config('app.name', 'Laravel') }}</strong></span>
            <div class="user-greeting">Mohon tunggu, <strong>{{ Auth::user()->name }}</strong>!</div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-kuning-polisi/60 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('layouts.partials.footer')
    </div>

    {{-- Script dari luar --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- Stack Scripts (buat Trix dll) --}}
    @stack('scripts')
     <script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.querySelector('.loader-wrapper').style.opacity = '0';
            setTimeout(function() {
                document.querySelector('.loader-wrapper').style.display = 'none';
            }, 500);
        }, 1000); // Sesuaikan waktu delay jika diperlukan
    });
    </script>
</body>

</html>
