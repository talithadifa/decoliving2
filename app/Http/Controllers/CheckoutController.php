<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout dengan QR DANA
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.checkout', compact('cart', 'total'));
    }

    /**
     * Memproses checkout dan menyimpan bukti pembayaran
     */
    public function store(Request $request)
    {
        // 1. Validasi file gambar
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Sesi keranjang telah habis.');
        }
        
        // 2. Hitung total harga
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // 3. Simpan gambar bukti pembayaran ke storage/app/public/payments
        $path = $request->file('payment_proof')->store('payments', 'public');

        // 4. Buat order baru
        // REVISI: Menggunakan 'total_amount' agar sesuai dengan kolom di database Anda
        $order = Order::create([
            'user_id'       => Auth::id(), 
            'total_amount'  => $total, 
            'payment_proof' => $path,
            'status'        => 'Menunggu Verifikasi'
        ]);

        // 5. Simpan detail item yang dibeli ke tabel order_items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $details['quantity'],
                'price'      => $details['price'],
            ]);
        }

        // 6. Kosongkan keranjang setelah data aman di database
        session()->forget('cart');

        return redirect()->route('orders.tracking')->with('success', 'Pesanan berhasil dikirim! Admin akan segera memverifikasi pembayaran Anda.');
    }
}