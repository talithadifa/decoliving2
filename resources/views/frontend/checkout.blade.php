@extends('layouts.app')

@section('content')
<style>
.glass-card{background:rgba(30,58,138,0.25);backdrop-filter:blur(12px);border:1px solid rgba(96,165,250,0.2);border-radius:1rem;}
.btn-pay{background:linear-gradient(135deg,#2563eb,#0ea5e9);color:white;font-weight:700;box-shadow:0 4px 24px rgba(37,99,235,0.4);border-radius:0.75rem;width:100%;padding:1rem;font-size:1rem;transition:all 0.3s;cursor:pointer;border:none;}
.btn-pay:hover{opacity:0.9;transform:translateY(-1px);box-shadow:0 8px 32px rgba(37,99,235,0.5);}
.btn-pay:disabled{background:rgba(30,58,138,0.3);color:#475569;box-shadow:none;transform:none;cursor:not-allowed;}
.item-row{background:rgba(15,23,42,0.3);border:1px solid rgba(96,165,250,0.1);border-radius:0.75rem;padding:0.75rem 1rem;}
</style>

<a href="{{ route('cart.index') }}" class="inline-flex items-center text-sm text-blue-300 hover:text-cyan-400 font-medium gap-1 mb-4">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Kembali ke Keranjang
</a>

<h1 class="text-2xl font-bold text-white mb-1">Checkout</h1>
<p class="text-blue-300 mb-8">Selesaikan pembayaran Anda dengan aman melalui Midtrans.</p>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    {{-- LEFT: Ringkasan Pesanan --}}
    <div>
        <div class="glass-card p-6 mb-6">
            <h3 class="font-bold text-white text-lg mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Ringkasan Pesanan
            </h3>
            <div class="space-y-3 mb-5">
                @foreach($cart as $id => $item)
                <div class="item-row flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0" style="border:1px solid rgba(96,165,250,0.2)">
                        @else
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center" style="background:rgba(37,99,235,0.2)">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                        @endif
                        <div>
                            <p class="text-white font-medium text-sm">{{ $item['name'] }}</p>
                            <p class="text-blue-400 text-xs">× {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <p class="text-white font-semibold text-sm">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <div class="border-t pt-4" style="border-color:rgba(96,165,250,0.15)">
                <div class="flex justify-between items-center">
                    <span class="text-blue-300 text-sm">Total Item</span>
                    <span class="text-white font-medium">{{ array_sum(array_column($cart, 'quantity')) }} pcs</span>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <span class="font-bold text-white text-lg">Total Pembayaran</span>
                    <span class="font-extrabold text-xl" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Payment Methods Info --}}
        <div class="glass-card p-5">
            <p class="text-xs text-blue-400 uppercase tracking-widest font-semibold mb-3">Metode Pembayaran Tersedia</p>
            <div class="grid grid-cols-3 gap-2">
                @foreach(['GoPay','OVO','DANA','BCA','BNI','BRI','Mandiri','Indomaret','Alfamart','QRIS'] as $method)
                <span class="text-center text-xs text-blue-300 py-1.5 px-2 rounded-lg font-medium" style="background:rgba(15,23,42,0.4);border:1px solid rgba(96,165,250,0.1)">{{ $method }}</span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- RIGHT: Tombol Bayar & Info --}}
    <div>
        <div class="glass-card p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center" style="background:linear-gradient(135deg,#2563eb,#0ea5e9)">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-1">Bayar dengan Midtrans</h3>
                <p class="text-blue-300 text-sm">Pilih metode pembayaran favoritmu — transfer bank, e-wallet, QRIS, atau gerai minimarket.</p>
            </div>

            <div class="mb-6 p-4 rounded-xl flex justify-between items-center" style="background:rgba(15,23,42,0.4);border:1px solid rgba(96,165,250,0.15)">
                <span class="text-blue-300 text-sm">Total yang dibayar</span>
                <span class="font-extrabold text-lg" style="background:linear-gradient(135deg,#60a5fa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>
            </div>

            {{-- Tombol Bayar Midtrans --}}
            <button id="pay-button" class="btn-pay">
                🔒 Bayar Sekarang
            </button>

            {{-- Loading state --}}
            <div id="pay-loading" class="hidden text-center py-4">
                <div class="inline-flex items-center gap-2 text-blue-300 text-sm">
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    Memproses pembayaran...
                </div>
            </div>

            {{-- Info keamanan --}}
            <div class="mt-6 flex items-start gap-3">
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <p class="text-xs text-blue-400 leading-relaxed">Pembayaran diproses secara aman oleh <strong class="text-blue-300">Midtrans</strong> — platform pembayaran terpercaya yang digunakan oleh ribuan merchant di Indonesia. Data Anda terenkripsi dengan SSL.</p>
            </div>
        </div>

        {{-- Status pesanan info --}}
        <div class="mt-4 glass-card p-4 flex items-center gap-3">
            <svg class="w-8 h-8 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-xs text-blue-300 leading-relaxed">Setelah pembayaran berhasil, status pesanan akan diperbarui otomatis. Anda bisa memantau pesanan di halaman <a href="{{ route('orders.tracking') }}" class="text-cyan-400 hover:text-cyan-300 font-medium">Pesanan Saya</a>.</p>
        </div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
const snapToken = "{{ $snapToken ?? '' }}";
const processUrl = "{{ route('checkout.process') }}";
const trackingUrl = "{{ route('orders.tracking') }}";
const csrfToken = "{{ csrf_token() }}";

document.getElementById('pay-button').addEventListener('click', function () {
    if (!snapToken) {
        alert('Token pembayaran tidak tersedia. Silakan refresh halaman.');
        return;
    }

    window.snap.pay(snapToken, {
        onSuccess: function(result) {
            // Kirim order ke server
            fetch(processUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    snap_token: snapToken,
                    payment_type: result.payment_type,
                    transaction_id: result.transaction_id,
                    order_id: result.order_id,
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    window.location.href = trackingUrl + '?success=1';
                }
            })
            .catch(() => {
                window.location.href = trackingUrl;
            });
        },
        onPending: function(result) {
            // Bayar nanti (transfer bank, dll)
            fetch(processUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    snap_token: snapToken,
                    payment_type: result.payment_type,
                    transaction_id: result.transaction_id,
                    order_id: result.order_id,
                })
            })
            .then(r => r.json())
            .then(data => {
                window.location.href = trackingUrl;
            });
        },
        onError: function(result) {
            alert('Pembayaran gagal: ' + (result.status_message || 'Silakan coba lagi.'));
        },
        onClose: function() {
            // User menutup popup tanpa bayar
            console.log('Popup ditutup tanpa menyelesaikan pembayaran');
        }
    });
});
</script>
@endsection