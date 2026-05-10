<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | DecoLiving</title>
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
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-primary-500 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-auto brightness-0 invert">
                <span class="text-xl font-bold text-white">DecoLiving</span>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white text-primary-500 rounded-lg text-sm font-medium hover:bg-blue-50 transition">Dashboard Admin</a>
                    @else
                        <a href="{{ route('cart.index') }}" class="text-white hover:text-blue-100 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg></a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="text-white hover:text-blue-100 font-medium text-sm">Logout</button></form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white hover:text-blue-100 font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-white text-primary-500 rounded-lg text-sm font-semibold hover:bg-blue-50 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- BREADCRUMB --}}
    <div class="max-w-7xl mx-auto px-6 py-4">
        <nav class="flex text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary-500 transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-medium">{{ $product->name }}</span>
        </nav>
    </div>

    {{-- PRODUCT DETAIL --}}
    <section class="max-w-7xl mx-auto px-6 pb-16">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                {{-- Image --}}
                <div class="bg-gray-100 flex items-center justify-center p-8 min-h-[400px]">
                    @if($product->image)
                        @php $imageUrl = str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image); @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="max-w-full max-h-[450px] object-contain rounded-xl">
                    @else
                        <div class="text-gray-300"><svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-8 md:p-10 flex flex-col justify-center">
                    @if($product->category)
                        <span class="inline-block bg-primary-50 text-primary-600 text-xs font-semibold px-3 py-1 rounded-full mb-4 w-fit">{{ $product->category->name }}</span>
                    @endif

                    <h1 class="text-3xl font-extrabold text-gray-900 mb-3">{{ $product->name }}</h1>

                    <div class="flex items-center gap-2 mb-4">
                        @for($i=0;$i<5;$i++)<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        <span class="text-sm text-gray-400">(4.8) · 120+ terjual</span>
                    </div>

                    <p class="text-3xl font-extrabold text-primary-500 mb-6">RP {{ number_format($product->price, 0, ',', '.') }}</p>

                    <p class="text-gray-600 leading-relaxed mb-6">{{ $product->description ?? 'Furnitur premium dengan desain modern dan kualitas terbaik untuk melengkapi hunian Anda.' }}</p>

                    <div class="flex items-center gap-3 mb-6 text-sm">
                        <span class="flex items-center gap-1 {{ $product->stock > 5 ? 'text-green-600' : 'text-red-500' }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                    @auth
                        @if(Auth::user()->role !== 'admin')
                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-10 py-3.5 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition shadow-lg shadow-primary-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full md:w-auto px-10 py-3.5 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition shadow-lg shadow-primary-200 flex items-center justify-center gap-2 text-center">
                            Login untuk Membeli
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $rp)
                <a href="{{ route('product.show', $rp->id) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="h-48 bg-gray-100 overflow-hidden">
                        @if($rp->image)
                            <img src="{{ asset('storage/'.$rp->image) }}" alt="{{ $rp->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900">{{ $rp->name }}</h3>
                        <p class="text-primary-500 font-extrabold mt-1">RP {{ number_format($rp->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </section>

</body>
</html>
