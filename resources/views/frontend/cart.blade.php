@extends('layouts.app')

@section('content')
<style>
.glass-card{background:rgba(30,58,138,0.25);backdrop-filter:blur(12px);border:1px solid rgba(96,165,250,0.2);border-radius:1rem;}
.input-count{background:rgba(15,23,42,0.5);border:1px solid rgba(96,165,250,0.3);color:#e2e8f0;}
.btn-blue{background:linear-gradient(135deg,#2563eb,#0ea5e9);color:white;font-weight:700;box-shadow:0 4px 24px rgba(37,99,235,0.4);}
.btn-blue:hover{opacity:0.9;}
</style>
<h1 class="text-2xl font-bold text-white mb-8">Keranjang Belanja</h1>

@if(session('success'))
                <div class="bg-blue-900/20 border border-blue-700/30 text-cyan-300 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
@endif

@if(count($cart) > 0)
    @php $total = 0; $shipping = 150000; @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $details)
                @php $total += $details['price'] * $details['quantity']; @endphp
                <div class="glass-card p-5 flex gap-5 items-start hover:border-blue-400/40 transition">
                    {{-- Product Image --}}
                    <div class="w-28 h-28 rounded-xl overflow-hidden flex-shrink-0" style="background:rgba(15,23,42,0.5)">
                        @if(isset($details['image']) && $details['image'])
                            <img src="{{ asset('storage/'.$details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-white text-lg">{{ $details['name'] }}</h3>
                            </div>
                            {{-- Delete Button --}}
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            {{-- Quantity Controls --}}
                            <div class="flex items-center gap-0 border border-blue-700/40 rounded-lg overflow-hidden" style="background:rgba(15,23,42,0.4)">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ max(1, $details['quantity'] - 1) }}">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-blue-300 hover:bg-blue-800/50 transition text-lg font-medium">−</button>
                                </form>
                                <span class="w-10 h-9 flex items-center justify-center text-sm font-semibold text-white border-x border-blue-700/40" style="background:rgba(15,23,42,0.3)">{{ $details['quantity'] }}</span>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center text-blue-300 hover:bg-blue-800/50 transition text-lg font-medium">+</button>
                                </form>
                            </div>

                            {{-- Price --}}
                        <p class="font-extrabold text-lg" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Order Summary Sidebar --}}
        <div class="lg:col-span-1">
        <div class="glass-card p-6 sticky top-24">
                <h3 class="text-lg font-bold text-white mb-5 pb-4 border-b border-blue-700/40">Ringkasan Pesanan</h3>
                
                <div class="space-y-3 mb-5">
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-300">Subtotal</span>
                        <span class="text-white font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-blue-300">Ongkos Kirim</span>
                        <span class="text-white font-medium">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-blue-700/40 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-white">Total Pembayaran</span>
                        <span class="text-xl font-extrabold" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">Rp {{ number_format($total + $shipping, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="block w-full text-center btn-blue py-3.5 rounded-xl transition">
                    Lanjut ke Pembayaran →
                </a>

                <p class="text-xs text-blue-400 text-center mt-4 leading-relaxed">Pajak dan biaya layanan sudah termasuk dalam total harga yang ditampilkan.</p>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-20 glass-card">
        <svg class="w-20 h-20 mx-auto mb-4 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
        <h3 class="text-xl font-bold text-white mb-2">Keranjang Anda masih kosong</h3>
        <p class="text-blue-300 mb-6">Yuk mulai belanja dan temukan furnitur impianmu!</p>
        <a href="{{ route('home') }}" class="inline-block px-8 py-3 btn-blue font-semibold rounded-xl transition">Mulai Belanja</a>
    </div>
@endif
@endsection