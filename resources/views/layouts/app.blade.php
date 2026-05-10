<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DecoLiving | Furniture Modern</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] }, colors: { primary: {50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#4361ee',600:'#3b52d4',700:'#2f42ab',800:'#243383',900:'#1a2463'} } } }
        }
    </script>
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800 flex flex-col">
    
    {{-- NAVBAR --}}
    <nav class="bg-primary-500 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <img src="{{ asset('img/logo.png') }}" alt="Logo DecoLiving" class="h-10 w-auto transition-transform group-hover:scale-105 brightness-0 invert">
                <span class="text-xl font-bold text-white tracking-tight">DecoLiving</span>
            </a>

            <div class="hidden md:flex items-center flex-1 max-w-lg mx-8">
                <form action="{{ route('home') }}" method="GET" class="w-full relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" placeholder="Cari sofa, meja, atau dekorasi..." class="w-full pl-10 pr-4 py-2.5 rounded-full border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 outline-none text-sm bg-white">
                </form>
            </div>

            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-white hover:text-blue-100 font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-white text-primary-500 rounded-lg text-sm font-semibold hover:bg-blue-50 transition">Daftar</a>
                @else
                    <a href="{{ route('cart.index') }}" class="relative text-white hover:text-blue-100 transition" title="Keranjang">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-white text-primary-500 text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @endif
                    </a>

                    {{-- Dropdown Akun --}}
                    <div class="relative" id="accountDropdown">
                        <button onclick="toggleDropdown()" class="flex items-center gap-2 text-sm text-white hover:text-blue-100 transition cursor-pointer">
                            <span class="font-medium">Akun Saya</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <svg class="w-4 h-4 transition-transform" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('orders.tracking') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Pesanan Saya
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 max-w-7xl w-full mx-auto px-6 py-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-primary-900 pt-16 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div>
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-9 w-auto brightness-0 invert">
                        <span class="text-xl font-bold text-white">DecoLiving</span>
                    </a>
                    <p class="text-blue-100 text-sm leading-relaxed mb-6">Wujudkan hunian impian Anda dengan koleksi furnitur premium terbaik di Indonesia. Desain modern, kualitas abadi.</p>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/decolivingofficial" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-primary-800 flex items-center justify-center text-blue-100 hover:bg-primary-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-primary-800 flex items-center justify-center text-blue-100 hover:bg-primary-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-primary-800 flex items-center justify-center text-blue-100 hover:bg-primary-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-3 text-sm text-blue-100">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-500 transition">Beranda</a></li>
                        <li><a href="{{ route('home') }}#produk" class="hover:text-primary-500 transition">Katalog</a></li>
                        @auth<li><a href="{{ route('orders.tracking') }}" class="hover:text-primary-500 transition">Lacak Pesanan</a></li>@endauth
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Kategori</h4>
                    <ul class="space-y-3 text-sm text-blue-100">
                        <li><a href="{{ route('home', ['search'=>'Sofa']) }}" class="hover:text-primary-500 transition">Sofa</a></li>
                        <li><a href="{{ route('home', ['search'=>'Meja']) }}" class="hover:text-primary-500 transition">Meja</a></li>
                        <li><a href="{{ route('home', ['search'=>'Kursi']) }}" class="hover:text-primary-500 transition">Kursi</a></li>
                        <li><a href="{{ route('home', ['search'=>'Lemari']) }}" class="hover:text-primary-500 transition">Lemari</a></li>
                        <li><a href="{{ route('home', ['search'=>'Dekorasi']) }}" class="hover:text-primary-500 transition">Dekorasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Kontak Kami</h4>
                    <ul class="space-y-3 text-sm text-blue-100">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jl. Modern Living No. 42, Jakarta Selatan
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            +62 21 555 1234
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            hello@decoliving.id
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-800 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-blue-200">
                <p>&copy; 2026 DecoLiving Indonesia. All rights reserved.</p>
                <div class="flex gap-6 mt-3 md:mt-0">
                    <a href="#" class="hover:text-primary-500 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-primary-500 transition">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        const arrow = document.getElementById('dropdownArrow');
        menu.classList.toggle('hidden');
        arrow.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('accountDropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            document.getElementById('dropdownMenu').classList.add('hidden');
            document.getElementById('dropdownArrow').style.transform = '';
        }
    });

    // Close dropdown when clicking on a menu item
    const dropdownLinks = document.querySelectorAll('#dropdownMenu a');
    dropdownLinks.forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('dropdownMenu').classList.add('hidden');
            document.getElementById('dropdownArrow').style.transform = '';
        });
    });
    </script>

</body>
</html>