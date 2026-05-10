<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru - DecoLiving</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50/50 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-900">Tambah Produk Baru</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-blue-600 transition">← Kembali</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-8">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                
                <!-- Nama Produk -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition outline-none"
                        placeholder="Contoh: Kursi Kayu Estetik">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 transition outline-none bg-white">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok Barang</label>
                        <input type="number" name="stock" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 transition outline-none"
                            placeholder="0">
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 transition outline-none"
                        placeholder="1500000">
                </div>

                <!-- URL Gambar -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL Gambar Produk</label>
                    <input type="url" name="image" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 transition outline-none"
                        placeholder="https://images.unsplash.com/...">
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="4" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 transition outline-none"
                        placeholder="Ceritakan detail material, ukuran, dll..."></textarea>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition transform active:scale-95">
                    Simpan Produk ke Katalog
                </button>
            </form>
        </div>
    </div>
</body>
</html>