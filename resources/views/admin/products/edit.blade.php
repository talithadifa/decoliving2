<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - DecoLiving Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-900">Edit Produk</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-blue-600 transition">← Batal</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-8">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <!-- Nama Produk -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ $product->name }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Stok -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 outline-none">
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $product->price }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 outline-none">
                </div>

                <!-- URL Gambar -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL Gambar</label>
                    <input type="url" name="image" value="{{ $product->image }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 outline-none">
                    <div class="mt-2 text-xs text-gray-400 italic text-center">Pratinjau Gambar Saat Ini:</div>
                    <img src="{{ $product->image }}" class="w-20 h-20 object-cover rounded-lg mx-auto mt-1 border">
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-blue-500 outline-none">{{ $product->description }}</textarea>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</body>
</html>