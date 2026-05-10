<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard beserta data produk & pesanan
    public function dashboard()
    {
        $products = Product::latest()->get();
        $orders = Order::latest()->get(); 
        
        return view('admin.dashboard', compact('products', 'orders'));
    }

    // Mengubah status pesanan (ACC / Tolak)
public function updateOrderStatus(Request $request, $id)
{
    $order = \App\Models\Order::findOrFail($id);
    $order->update(['status' => $request->status]);

    // Kembalikan ke dashboard agar tidak memicu GET request pada URL status
    return redirect()->route('admin.dashboard')->with('success', 'Status pesanan berhasil diperbarui!');
}

    // Menampilkan form tambah produk
    public function createProduct()
    {
        $categories = Category::all();
        // Nanti kita buat file view-nya jika belum ada
        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan produk baru
    public function storeProduct(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Menyimpan perubahan produk
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diupdate!');
    }

    // Menghapus produk
    public function destroyProduct($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    
}