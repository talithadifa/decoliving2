<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DecoLiving</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-white min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-3xl font-bold text-blue-600">Admin Dashboard</h1>
                <div class="flex items-center gap-4">
                    <a href="/" class="text-gray-500 hover:text-blue-500 font-medium">Lihat Website</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 font-medium">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-blue-100 p-4 rounded-lg border border-blue-200">
                    <h2 class="text-xl font-semibold text-blue-800">Total Produk</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ $products->count() }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg border border-green-200">
                    <h2 class="text-xl font-semibold text-green-800">Pesanan Masuk</h2>
                    <p class="text-3xl font-bold text-green-600">{{ $orders->count() }}</p>
                </div>
                <div class="bg-orange-100 p-4 rounded-lg border border-orange-200">
                    <h2 class="text-xl font-semibold text-orange-800">Menunggu Verifikasi</h2>
                    <p class="text-3xl font-bold text-orange-600">{{ $orders->where('status', 'Menunggu Verifikasi')->count() }}</p>
                </div>
            </div>

            <!-- Tabel Pesanan (Orders) -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Pesanan Masuk</h2>
                <div class="overflow-x-auto bg-gray-50 rounded-lg border border-gray-200">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="p-3">ID Order</th>
                                <th class="p-3">Total Harga</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Bukti Bayar</th>
                                <th class="p-3 text-center">Aksi (Ubah Status)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="border-b border-gray-200">
                                <td class="p-3 font-medium text-gray-900">#ORD-{{ $order->id }}</td>
                                <td class="p-3 text-blue-600 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $order->status == 'Menunggu Verifikasi' ? 'bg-orange-100 text-orange-700' : '' }}
                                        {{ $order->status == 'Diproses' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $order->status == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-500 underline">Lihat Bukti</a>
                                </td>
                                <td class="p-3 flex justify-center gap-2">
                                   <!-- Form untuk ACC Pesanan -->
<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
    @csrf
    @method('PATCH') <!-- WAJIB ADA agar tidak dianggap POST biasa -->
    <input type="hidden" name="status" value="Diproses">
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">
        ACC
    </button>
</form>

<!-- Form untuk Tolak Pesanan -->
<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
    @csrf
    @method('PATCH') <!-- WAJIB ADA -->
    <input type="hidden" name="status" value="Ditolak">
    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
        Tolak
    </button>
</form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="p-4 text-center text-gray-500">Belum ada pesanan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Produk -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk</h2>
                    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">+ Tambah Produk</a>
                </div>
                <div class="overflow-x-auto bg-gray-50 rounded-lg border border-gray-200">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="p-3">Gambar</th>
                                <th class="p-3">Nama Produk</th>
                                <th class="p-3">Harga</th>
                                <th class="p-3">Stok</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="border-b border-gray-200">
                                <td class="p-3">
                                    <img src="{{ $product->image }}" class="w-12 h-12 object-cover rounded">
                                </td>
                                <td class="p-3 font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="p-3 text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3 flex justify-center gap-2 mt-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>