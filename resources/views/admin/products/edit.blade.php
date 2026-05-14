<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - DecoLiving Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 30%,#0c1a3d 60%,#0f2855 100%); min-height:100vh; color:#e2e8f0; }
        .navbar-glass { background:rgba(15,23,42,0.6); backdrop-filter:blur(20px); border-bottom:1px solid rgba(96,165,250,0.2); }
        .orb { position:fixed; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:0; }
        .orb-1 { width:500px; height:500px; background:rgba(37,99,235,0.10); top:-100px; right:-100px; }
        .orb-2 { width:400px; height:400px; background:rgba(6,182,212,0.07); bottom:100px; left:-100px; }
        .glass-card { background:rgba(30,58,138,0.25); backdrop-filter:blur(12px); border:1px solid rgba(96,165,250,0.2); border-radius:1rem; }
        .dark-input { background:rgba(15,23,42,0.5); border:1px solid rgba(96,165,250,0.25); color:#e2e8f0; border-radius:0.75rem; padding:0.75rem 1rem; width:100%; font-size:0.875rem; outline:none; transition:all 0.2s; }
        .dark-input:focus { border-color:#60a5fa; box-shadow:0 0 0 3px rgba(96,165,250,0.15); }
        .dark-input::placeholder { color:#475569; }
        .dark-input:-webkit-autofill,
        .dark-input:-webkit-autofill:hover,
        .dark-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px rgba(15,23,42,0.9) inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            border-color: rgba(96,165,250,0.3) !important;
        }
        .btn-primary { background:linear-gradient(135deg,#2563eb,#0ea5e9); color:white; font-weight:700; border-radius:0.75rem; padding:0.875rem 1rem; width:100%; transition:all 0.3s; box-shadow:0 4px 24px rgba(37,99,235,0.4); font-size:0.9375rem; }
        .btn-primary:hover { opacity:0.9; transform:translateY(-1px); box-shadow:0 8px 32px rgba(37,99,235,0.5); }
        ::-webkit-scrollbar{width:6px} ::-webkit-scrollbar-track{background:#0f172a} ::-webkit-scrollbar-thumb{background:linear-gradient(#3b82f6,#0ea5e9);border-radius:3px}
    </style>
</head>
<body class="relative">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- NAVBAR -->
    <nav class="navbar-glass sticky top-0 z-50 relative">
        <div class="max-w-7xl mx-auto px-6 py-3.5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#2563eb,#0ea5e9)">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <div>
                    <span class="font-extrabold text-white text-lg leading-none">DecoLiving</span>
                    <span class="ml-2 text-xs font-semibold px-2 py-0.5 rounded-full text-cyan-300" style="background:rgba(6,182,212,0.15);border:1px solid rgba(6,182,212,0.3)">ADMIN</span>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1.5 text-sm text-blue-300 hover:text-white transition font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Batal & Kembali
            </a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10 relative z-10">
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-white mb-1">Edit Produk</h1>
            <p class="text-blue-300 text-sm">Perbarui informasi produk <span class="text-cyan-400 font-semibold">{{ $product->name }}</span></p>
        </div>

        <div class="glass-card p-8">
            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl text-red-300 text-sm" style="background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.25)">
                    <ul class="space-y-1">@foreach($errors->all() as $e)<li>• {{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Nama Produk -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-blue-200 mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="dark-input" placeholder="Nama produk">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-200 mb-2">Kategori</label>
                        <select name="category_id" required class="dark-input" style="cursor:pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" style="background:#0f172a"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-200 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                            class="dark-input" placeholder="0">
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-blue-200 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                        class="dark-input" placeholder="1500000">
                </div>

                <!-- URL / Gambar -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-blue-200 mb-2">URL Gambar</label>
                    <input type="text" name="image" value="{{ old('image', $product->image) }}" required
                        class="dark-input" placeholder="https://...">

                    @if($product->image)
                    <div class="mt-3 flex items-center gap-3 p-3 rounded-xl" style="background:rgba(15,23,42,0.4);border:1px solid rgba(96,165,250,0.15)">
                        @php $previewUrl = str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image); @endphp
                        <img src="{{ $previewUrl }}" alt="Preview"
                             class="w-16 h-16 object-cover rounded-lg flex-shrink-0" style="border:1px solid rgba(96,165,250,0.2)">
                        <div>
                            <p class="text-xs text-blue-300 font-medium">Gambar saat ini</p>
                            <p class="text-xs text-blue-500 mt-0.5 truncate max-w-xs">{{ $product->image }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-blue-200 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" required
                        class="dark-input resize-none"
                        placeholder="Deskripsi detail produk...">{{ old('description', $product->description) }}</textarea>
                </div>

                <button type="submit" class="btn-primary">
                    💾 Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</body>
</html>