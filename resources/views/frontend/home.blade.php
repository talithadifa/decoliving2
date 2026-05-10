@extends('layouts.app')

@section('content')
<div class="text-center py-12 mb-8">
    <h1 class="text-5xl font-extrabold text-blue-900 mb-4">Temukan Furniture Impian Anda</h1>
    <p class="text-lg text-gray-600">Koleksi minimalis dan modern untuk rumah dan kantor (DecoLiving).</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 border border-blue-50 overflow-hidden">
        <div class="h-48 bg-gray-200 w-full">
            @if($product->image)
                @php $imageUrl = str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image); @endphp
                <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="p-5">
            <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $product->name }}</h3>
            <p class="text-blue-600 font-extrabold text-xl mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-50 text-blue-600 font-semibold py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
                    + Keranjang
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-10 text-gray-500">
        Belum ada produk furniture. Silakan tambahkan via Admin.
    </div>
    @endforelse
</div>
@endsection