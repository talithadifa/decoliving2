<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'DecoLiving') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] }, colors: { primary: {50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#4361ee',600:'#3b52d4',700:'#2f42ab',800:'#243383',900:'#1a2463'} } } }
            }
        </script>
        <style>
            body { font-family:'Inter',sans-serif; }
            .auth-bg { background: linear-gradient(135deg, #4361ee 0%, #1a2463 100%); }
        </style>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            {{-- Left: Branding Panel --}}
            <div class="hidden lg:flex lg:w-1/2 auth-bg flex-col justify-center items-center px-12 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-300 rounded-full blur-3xl"></div>
                </div>
                <div class="relative z-10 text-center max-w-md">
                    <a href="/" class="flex items-center justify-center gap-3 mb-8">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo DecoLiving" class="h-16 w-auto brightness-0 invert">
                        <span class="text-3xl font-bold text-white tracking-tight">DecoLiving</span>
                    </a>
                    <h2 class="text-2xl font-bold text-white mb-4">Wujudkan Ruang Nyaman Impianmu</h2>
                    <p class="text-blue-200 text-base leading-relaxed">Koleksi furnitur eksklusif dengan desain modern dan kualitas premium untuk setiap sudut hunian Anda.</p>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 bg-gray-50">
                <div class="lg:hidden mb-8">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-auto">
                        <span class="text-2xl font-bold text-gray-900">DecoLiving</span>
                    </a>
                </div>
                <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    {{ $slot }}
                </div>
                <p class="mt-6 text-xs text-gray-400">&copy; 2026 DecoLiving Indonesia</p>
            </div>
        </div>
    </body>
</html>
