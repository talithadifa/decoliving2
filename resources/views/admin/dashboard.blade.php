<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DecoLiving</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 30%,#0c1a3d 60%,#0f2855 100%); min-height:100vh; color:#e2e8f0; }
        .navbar-glass { background:rgba(15,23,42,0.6); backdrop-filter:blur(20px); border-bottom:1px solid rgba(96,165,250,0.2); }
        .orb { position:fixed; border-radius:50%; filter:blur(80px); pointer-events:none; z-index:0; }
        .orb-1 { width:500px; height:500px; background:rgba(37,99,235,0.10); top:-100px; right:-100px; }
        .orb-2 { width:400px; height:400px; background:rgba(6,182,212,0.07); bottom:200px; left:-100px; }
        .glass-card { background:rgba(30,58,138,0.25); backdrop-filter:blur(12px); border:1px solid rgba(96,165,250,0.2); border-radius:1rem; }
        .glass-table { background:rgba(15,23,42,0.4); backdrop-filter:blur(8px); border:1px solid rgba(96,165,250,0.15); border-radius:1rem; overflow:hidden; }
        .btn-primary { background:linear-gradient(135deg,#2563eb,#0ea5e9); color:white; font-weight:700; border-radius:0.6rem; padding:0.5rem 1.25rem; font-size:0.875rem; transition:all 0.2s; box-shadow:0 4px 16px rgba(37,99,235,0.3); display:inline-flex; align-items:center; gap:0.4rem; }
        .btn-primary:hover { opacity:0.9; transform:translateY(-1px); }
        .btn-sm-green { background:rgba(34,197,94,0.2); color:#4ade80; border:1px solid rgba(34,197,94,0.35); border-radius:0.5rem; padding:0.35rem 0.85rem; font-size:0.75rem; font-weight:600; transition:all 0.2s; }
        .btn-sm-green:hover { background:rgba(34,197,94,0.35); }
        .btn-sm-red { background:rgba(239,68,68,0.2); color:#f87171; border:1px solid rgba(239,68,68,0.35); border-radius:0.5rem; padding:0.35rem 0.85rem; font-size:0.75rem; font-weight:600; transition:all 0.2s; }
        .btn-sm-red:hover { background:rgba(239,68,68,0.35); }
        .btn-sm-yellow { background:rgba(245,158,11,0.2); color:#fbbf24; border:1px solid rgba(245,158,11,0.35); border-radius:0.5rem; padding:0.35rem 0.85rem; font-size:0.75rem; font-weight:600; transition:all 0.2s; }
        .btn-sm-yellow:hover { background:rgba(245,158,11,0.35); }
        .badge-amber { background:rgba(245,158,11,0.15); color:#fbbf24; border:1px solid rgba(245,158,11,0.3); }
        .badge-blue  { background:rgba(59,130,246,0.15);  color:#60a5fa; border:1px solid rgba(59,130,246,0.3); }
        .badge-green { background:rgba(34,197,94,0.15);   color:#4ade80; border:1px solid rgba(34,197,94,0.3); }
        .badge-red   { background:rgba(239,68,68,0.15);   color:#f87171; border:1px solid rgba(239,68,68,0.3); }
        .stat-card-blue  { background:linear-gradient(135deg,rgba(37,99,235,0.3),rgba(14,165,233,0.2)); border:1px solid rgba(96,165,250,0.3); }
        .stat-card-green { background:linear-gradient(135deg,rgba(5,150,105,0.3),rgba(16,185,129,0.2)); border:1px solid rgba(52,211,153,0.3); }
        .stat-card-amber { background:linear-gradient(135deg,rgba(180,83,9,0.3),rgba(217,119,6,0.2)); border:1px solid rgba(251,191,36,0.3); }
        thead tr th { background:rgba(15,23,42,0.6) !important; color:#93c5fd; font-weight:600; font-size:0.75rem; letter-spacing:0.06em; text-transform:uppercase; padding:0.9rem 1rem; border-bottom:1px solid rgba(96,165,250,0.15); }
        tbody tr { border-bottom:1px solid rgba(96,165,250,0.08); transition:background 0.15s; }
        tbody tr:hover { background:rgba(37,99,235,0.08); }
        tbody tr:last-child { border-bottom:none; }
        tbody td { padding:0.85rem 1rem; color:#cbd5e1; font-size:0.875rem; }
        ::-webkit-scrollbar{width:6px;height:6px} ::-webkit-scrollbar-track{background:#0f172a} ::-webkit-scrollbar-thumb{background:linear-gradient(#3b82f6,#0ea5e9);border-radius:3px}
        .gradient-text { background:linear-gradient(135deg,#60a5fa,#22d3ee); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    </style>
</head>
<body class="relative">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- NAVBAR ADMIN -->
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

            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-1.5 text-sm text-blue-300 hover:text-white transition font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                <div class="h-4 w-px" style="background:rgba(96,165,250,0.2)"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm text-red-400 hover:text-red-300 font-medium transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-white mb-1">Admin Dashboard</h1>
            <p class="text-blue-300">Kelola produk, pesanan, dan data toko DecoLiving</p>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl text-sm flex items-center gap-2 text-cyan-300" style="background:rgba(6,182,212,0.12);border:1px solid rgba(6,182,212,0.25)">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- STATISTIK CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
            <div class="stat-card-blue rounded-2xl p-6 backdrop-blur-md">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider">Total Produk</p>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(37,99,235,0.3)">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
                <p class="text-4xl font-extrabold text-white">{{ $products->count() }}</p>
                <p class="text-blue-400 text-xs mt-1">produk di katalog</p>
            </div>
            <div class="stat-card-green rounded-2xl p-6 backdrop-blur-md">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-emerald-300 text-sm font-semibold uppercase tracking-wider">Pesanan Masuk</p>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(5,150,105,0.3)">
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                </div>
                <p class="text-4xl font-extrabold text-white">{{ $orders->count() }}</p>
                <p class="text-emerald-400 text-xs mt-1">total pesanan</p>
            </div>
            <div class="stat-card-amber rounded-2xl p-6 backdrop-blur-md">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-amber-300 text-sm font-semibold uppercase tracking-wider">Menunggu Verifikasi</p>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(180,83,9,0.3)">
                        <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-4xl font-extrabold text-white">{{ $orders->where('status', 'Menunggu Verifikasi')->count() }}</p>
                <p class="text-amber-400 text-xs mt-1">menunggu konfirmasi</p>
            </div>
        </div>

        <!-- TABEL PESANAN -->
        <div class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Daftar Pesanan Masuk
                </h2>
                <span class="text-xs text-blue-400 font-medium px-3 py-1 rounded-full" style="background:rgba(37,99,235,0.15);border:1px solid rgba(37,99,235,0.25)">{{ $orders->count() }} pesanan</span>
            </div>

            <div class="glass-table">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr>
                                <th>ID Order</th>
                                <th>Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th class="text-center">Bukti Bayar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>
                                    <span class="font-bold text-white">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div>
                                        <p class="text-white font-medium text-sm">{{ $order->user->name ?? 'N/A' }}</p>
                                        <p class="text-blue-400 text-xs">{{ $order->user->email ?? '' }}</p>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-bold" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->status == 'Menunggu Verifikasi')
                                        <span class="inline-flex items-center gap-1.5 badge-amber px-3 py-1 rounded-full text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-pulse"></span>
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status == 'Diproses')
                                        <span class="inline-flex items-center gap-1.5 badge-blue px-3 py-1 rounded-full text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status == 'Selesai')
                                        <span class="inline-flex items-center gap-1.5 badge-green px-3 py-1 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            {{ $order->status }}
                                        </span>
                                    @elseif($order->status == 'Ditolak')
                                        <span class="inline-flex items-center gap-1.5 badge-red px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $order->status }}
                                        </span>
                                    @else
                                        <span class="text-blue-400 text-xs">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                       class="inline-flex items-center gap-1 text-xs text-cyan-400 hover:text-cyan-300 font-medium transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat Bukti
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Diproses">
                                            <button type="submit" class="btn-sm-green">✓ ACC</button>
                                        </form>
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit" class="btn-sm-red">✕ Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 text-blue-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TABEL PRODUK -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Manajemen Produk
                </h2>
                <a href="{{ route('admin.products.create') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Produk
                </a>
            </div>

            <div class="glass-table">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    @php $imgUrl = str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image); @endphp
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                         class="w-12 h-12 object-cover rounded-lg" style="border:1px solid rgba(96,165,250,0.2)">
                                </td>
                                <td>
                                    <span class="font-semibold text-white">{{ $product->name }}</span>
                                </td>
                                <td>
                                    <span class="text-xs px-2.5 py-1 rounded-full font-medium badge-blue">{{ $product->category->name ?? 'Umum' }}</span>
                                </td>
                                <td>
                                    <span class="font-bold" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="{{ $product->stock < 5 ? 'badge-red' : 'badge-green' }} text-xs px-2.5 py-1 rounded-full font-semibold">
                                        {{ $product->stock }} pcs
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-sm-yellow">
                                            ✏ Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn-sm-red">🗑 Hapus</button>
                                        </form>
                                    </div>
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