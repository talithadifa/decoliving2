<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

// Import semua Controller yang dipakai
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProfileController;

// ==========================================
// 1. HALAMAN UTAMA (Katalog Produk)
// ==========================================
Route::get('/', [ProductController::class, 'index'])->name('home');

// ==========================================
// 1b. DETAIL PRODUK
// ==========================================
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ==========================================
// 2. RUTE ADMIN
// ==========================================
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// Rute Dashboard & Kelola Data Admin
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Rute Kelola Pesanan
    Route::patch('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    
    // Rute Kelola Produk
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::patch('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
});

// ==========================================
// 3. RUTE CUSTOMER (Harus Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.process');
    Route::get('/checkout/finish', [CheckoutController::class, 'finish'])->name('checkout.finish');

    // Halaman Tracking Order
    Route::get('/orders/tracking', function () {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('frontend.tracking', compact('orders'));
    })->name('orders.tracking');
});

// ==========================================
// 4. FIX REDIRECT BREEZE SETELAH LOGIN
// ==========================================
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/'); // Alihkan ke Homepage untuk user biasa
})->middleware(['auth'])->name('dashboard');

// Route bawaan Laravel Breeze
require __DIR__.'/auth.php';

// ==========================================
// 5. MIDTRANS WEBHOOK NOTIFICATION
// ==========================================
Route::post('/midtrans/notification', [CheckoutController::class, 'notification'])
    ->name('midtrans.notification');