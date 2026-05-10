<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua kategori untuk ditampilkan di sidebar/tombol filter
        $categories = Category::all();
        
        // Memulai query pada model Product
        $query = Product::query();

        // Fitur Search: Hanya dijalankan jika input 'search' tidak kosong
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Kategori: Menggunakan 'filled' untuk memastikan ID kategori ada
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Mengambil data produk terbaru sesuai mode tampilan
        if ($request->has('view_all')) {
            $products = $query->latest()->get();
        } else {
            $products = $query->latest()->take(4)->get();
        }

        // Mengirim data ke view 'welcome'
        return view('welcome', compact('categories', 'products'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();
        return view('frontend.product-detail', compact('product', 'relatedProducts'));
    }
}