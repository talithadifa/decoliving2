@extends('layouts.app')

@section('content')
<style>
.glass-card{background:rgba(30,58,138,0.25);backdrop-filter:blur(12px);border:1px solid rgba(96,165,250,0.2);border-radius:1rem;}
.badge-amber{background:rgba(245,158,11,0.15);color:#fbbf24;border:1px solid rgba(245,158,11,0.3);}
.badge-blue{background:rgba(59,130,246,0.15);color:#60a5fa;border:1px solid rgba(59,130,246,0.3);}
.badge-green{background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);}
.badge-red{background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3);}
.btn-blue{background:linear-gradient(135deg,#2563eb,#0ea5e9);color:white;font-weight:700;}
</style>
<h1 class="text-2xl font-bold text-white mb-2">Pesanan Saya</h1>
<p class="text-blue-300 mb-8">Pantau status pesanan Anda di sini.</p>

@if(session('success'))
    {{-- Success Modal Overlay --}}
    <div id="successOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="glass-card p-10 text-center max-w-sm mx-4 shadow-2xl">
            <div class="w-20 h-20 mx-auto mb-5 rounded-full flex items-center justify-center" style="background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.3)">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-3">Terima Kasih!</h3>
            <p class="text-blue-300 text-sm leading-relaxed">Pesanan Anda sedang diverifikasi oleh tim kami.</p>
            <button onclick="document.getElementById('successOverlay').style.display='none'" class="mt-6 px-8 py-2.5 btn-blue font-semibold rounded-xl text-sm">Tutup</button>
        </div>
    </div>
@endif

@if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="glass-card overflow-hidden hover:border-blue-400/40 transition">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    {{-- Order Info --}}
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(37,99,235,0.2);border:1px solid rgba(96,165,250,0.2)">
                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-lg">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-sm text-blue-400">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    {{-- Amount & Status --}}
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-xs text-blue-400 uppercase tracking-wider">Total</p>
                            <p class="font-extrabold text-lg" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            @if($order->status == 'Menunggu Verifikasi')
                                <span class="inline-flex items-center gap-1.5 badge-amber px-4 py-1.5 rounded-full text-xs font-semibold">
                                    <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                                    Menunggu Verifikasi
                                </span>
                            @elseif($order->status == 'Diproses')
                                <span class="inline-flex items-center gap-1.5 badge-blue px-4 py-1.5 rounded-full text-xs font-semibold">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                                    Sedang Diproses
                                </span>
                            @elseif($order->status == 'Selesai')
                                <span class="inline-flex items-center gap-1.5 badge-green px-4 py-1.5 rounded-full text-xs font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 badge-red px-4 py-1.5 rounded-full text-xs font-semibold">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Payment Method --}}
                @if($order->payment_method)
                <div class="px-6 pb-4">
                    <span class="text-xs text-blue-400">Via: <span class="text-cyan-400 font-semibold uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span></span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-20 glass-card">
        <svg class="w-20 h-20 mx-auto mb-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        <h3 class="text-xl font-bold text-white mb-2">Belum ada pesanan</h3>
        <p class="text-blue-300 mb-6">Anda belum melakukan pemesanan. Yuk mulai belanja!</p>
        <a href="{{ route('home') }}" class="inline-block px-8 py-3 btn-blue font-semibold rounded-xl transition">Mulai Belanja</a>
    </div>
@endif
@endsection