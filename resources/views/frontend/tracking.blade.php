@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Saya</h1>
<p class="text-gray-500 mb-8">Pantau status pesanan Anda di sini.</p>

@if(session('success'))
    {{-- Success Modal Overlay --}}
    <div id="successOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-10 text-center max-w-sm mx-4 shadow-2xl">
            <div class="w-20 h-20 mx-auto mb-5 bg-green-50 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Terima Kasih!</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Pesanan Anda sedang diverifikasi oleh tim kami. Anda akan dialihkan ke halaman pelacakan dalam waktu dekat.</p>
            <button onclick="document.getElementById('successOverlay').style.display='none'" class="mt-6 px-8 py-2.5 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition text-sm">Tutup</button>
        </div>
    </div>
@endif

@if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    {{-- Order Info --}}
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    {{-- Amount & Status --}}
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Total</p>
                            <p class="font-extrabold text-primary-500 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'Menunggu Verifikasi')
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-amber-200">
                                    <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                                    Menunggu Verifikasi
                                </span>
                            @elseif($order->status == 'Diproses')
                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-blue-200">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                                    Sedang Diproses
                                </span>
                            @elseif($order->status == 'Selesai')
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-4 py-1.5 rounded-full text-xs font-semibold border border-red-200">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
        <svg class="w-20 h-20 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada pesanan</h3>
        <p class="text-gray-500 mb-6">Anda belum melakukan pemesanan. Yuk mulai belanja!</p>
        <a href="{{ route('home') }}" class="inline-block px-8 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition shadow-lg shadow-primary-200">Mulai Belanja</a>
    </div>
@endif
@endsection