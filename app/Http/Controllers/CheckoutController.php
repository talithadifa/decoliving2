<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Tampilkan halaman checkout & buat Snap Token Midtrans
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        $itemDetails = [];

        foreach ($cart as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total   += $subtotal;
            $itemDetails[] = [
                'id'       => (string) $id,
                'price'    => (int) $item['price'],
                'quantity' => (int) $item['quantity'],
                'name'     => substr($item['name'], 0, 50), // Midtrans max 50 char
            ];
        }

        $user  = Auth::user();
        $orderId = 'DECO-' . Auth::id() . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'      => $orderId,
                'gross_amount'  => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone ?? '08123456789',
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('checkout.finish'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')
                ->with('error', 'Gagal menghubungi Midtrans: ' . $e->getMessage());
        }

        // Simpan order_id sementara ke session
        session(['midtrans_order_id' => $orderId, 'midtrans_total' => $total]);

        return view('frontend.checkout', compact('cart', 'total', 'snapToken'));
    }

    /**
     * Halaman finish setelah pembayaran (redirect dari Midtrans)
     */
    public function finish(Request $request)
    {
        return redirect()->route('orders.tracking')
            ->with('success', 'Pembayaran berhasil! Pesanan Anda sedang diproses.');
    }

    /**
     * Webhook Notification dari Midtrans (server-to-server)
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId           = $notification->order_id;
            $statusCode        = $notification->status_code;
            $grossAmount       = $notification->gross_amount;
            $signatureKey      = $notification->signature_key;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $paymentType       = $notification->payment_type;

            // Validasi signature
            $serverKey = config('midtrans.server_key');
            $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($signatureKey !== $expectedSignature) {
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            // Cari order berdasarkan midtrans_order_id
            $order = Order::where('midtrans_order_id', $orderId)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Update status berdasarkan Midtrans response
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                if ($fraudStatus == 'accept' || $fraudStatus == null) {
                    $order->status         = 'Diproses';
                    $order->payment_method = $paymentType;
                }
            } elseif ($transactionStatus == 'pending') {
                $order->status = 'Menunggu Verifikasi';
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $order->status = 'Dibatalkan';
            }

            $order->save();

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Proses order setelah Midtrans callback di frontend (Snap JS)
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        $total    = session('midtrans_total', 0);
        $orderId  = session('midtrans_order_id');

        $order = Order::create([
            'user_id'           => Auth::id(),
            'total_amount'      => $total,
            'payment_proof'     => null,
            'snap_token'        => $request->snap_token ?? null,
            'midtrans_order_id' => $orderId,
            'payment_method'    => $request->payment_type ?? null,
            'status'            => 'Menunggu Verifikasi',
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $details['quantity'],
                'price'      => $details['price'],
            ]);
        }

        session()->forget(['cart', 'midtrans_order_id', 'midtrans_total']);

        return response()->json(['success' => true, 'redirect' => route('orders.tracking')]);
    }
}