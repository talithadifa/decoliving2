@extends('layouts.app')

@section('content')
<a href="{{ route('cart.index') }}" class="inline-flex items-center text-sm text-primary-500 hover:text-primary-700 font-medium gap-1 mb-4">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Kembali ke Keranjang
</a>

<h1 class="text-2xl font-bold text-gray-900 mb-2">Checkout</h1>
<p class="text-gray-500 mb-8">Silakan selesaikan pembayaran untuk memproses pesanan Anda.</p>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Left: Payment QR --}}
    <div>
        <div class="bg-gradient-to-br from-primary-50 to-blue-50 rounded-2xl p-8 text-center border border-blue-100">
            <div class="bg-white rounded-xl p-6 inline-block mb-4 shadow-sm">
                <img src="{{ asset('img/qr.jpeg') }}" alt="QR Payment DecoLiving" class="w-52 h-52 object-contain mx-auto">
            </div>
            
            <p class="text-xs tracking-widest uppercase font-bold text-primary-600 mb-1">Total Pembayaran</p>
            <p class="text-3xl font-extrabold text-gray-900 mb-3">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</p>
            
            <div class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-4 py-1.5 rounded-full border border-green-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Metode Pembayaran Aman (QRIS)
            </div>
        </div>

        {{-- Instructions --}}
        <div class="mt-6">
            <h3 class="font-bold text-gray-900 mb-4">Instruksi Pembayaran:</h3>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                    <p class="text-sm text-gray-600">Scan kode QR di atas menggunakan aplikasi bank atau e-wallet Anda.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                    <p class="text-sm text-gray-600">Pastikan nominal pembayaran sesuai dengan total yang tertera.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                    <p class="text-sm text-gray-600">Upload bukti transfer di form yang tersedia di sebelah kanan.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Upload & Confirm --}}
    <div>
        <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Konfirmasi Pembayaran</h3>

            <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
                @csrf
                
                {{-- File Upload Area --}}
                <div class="mb-6">
                    <label class="block w-full cursor-pointer" id="uploadLabel">
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-primary-300 hover:bg-primary-50/30 transition group" id="dropZone">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300 group-hover:text-primary-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p class="font-semibold text-gray-600 text-sm" id="fileName">Klik atau Tarik Bukti Transfer Ke Sini</p>
                            <p class="text-xs text-gray-400 mt-1 tracking-wide uppercase">PNG, JPG up to 5MB</p>
                        </div>
                        <input type="file" name="payment_proof" required class="hidden" id="fileInput" accept="image/*" onchange="updateFileName(this)">
                    </label>
                    @error('payment_proof')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gray-200 text-gray-500 font-bold py-3.5 rounded-xl transition cursor-not-allowed" id="submitBtn" disabled>
                    Konfirmasi Pesanan
                </button>
            </form>
        </div>

        {{-- Security Badge --}}
        <div class="mt-6 flex items-start gap-3 bg-blue-50 rounded-xl p-4 border border-blue-100">
            <svg class="w-8 h-8 text-primary-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <p class="text-xs text-gray-500 leading-relaxed uppercase tracking-wide font-medium">Data Anda dienkripsi secara aman. DecoLiving tidak menyimpan data finansial Anda. Semua transaksi diproses melalui gateway pembayaran resmi.</p>
        </div>
    </div>
</div>

{{-- Success Modal (shown after form submit via session) --}}
@if(session('checkout_success'))
<div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-10 text-center max-w-sm mx-4 shadow-2xl animate-bounce-in">
        <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Terima Kasih!</h3>
        <p class="text-gray-500 text-sm">Pesanan Anda sedang diverifikasi oleh tim kami. Anda akan dialihkan ke halaman pelacakan dalam waktu dekat.</p>
    </div>
</div>
@endif

<script>
function updateFileName(input) {
    const fileName = document.getElementById('fileName');
    const submitBtn = document.getElementById('submitBtn');
    if (input.files && input.files[0]) {
        fileName.textContent = input.files[0].name;
        fileName.classList.add('text-primary-600');
        submitBtn.disabled = false;
        submitBtn.className = 'w-full bg-primary-500 text-white font-bold py-3.5 rounded-xl hover:bg-primary-600 transition shadow-lg shadow-primary-200 cursor-pointer';
    }
}
</script>
@endsection