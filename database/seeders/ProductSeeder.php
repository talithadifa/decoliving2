<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // ── SOFA ──────────────────────────────────────────────────────────
            [
                'category_name' => 'Sofa',
                'name'          => 'Sofa Minimalis Modern',
                'description'   => 'Sofa dengan desain minimalis dan nyaman untuk ruang tamu Anda.',
                'price'         => 2500000,
                'stock'         => 10,
                'image'         => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800',
            ],
            [
                'category_name' => 'Sofa',
                'name'          => 'Sofa L-Shaped Premium',
                'description'   => 'Sofa L-shape modern dengan kain berkualitas dan bantalan empuk. Ukuran 1945x1400x730 mm, cover fabric Brentwood Granite, rangka kayu solid.',
                'price'         => 4200000,
                'stock'         => 7,
                // Gambar langsung dari produk Davon Sofa L Shape - idemu.com
                'image'         => 'https://www.idemu.com/wp-content/uploads/2023/05/DAVON-Sofa-L-Shape-Truffle-600x600.png',
            ],

            // ── MEJA ──────────────────────────────────────────────────────────
            [
                'category_name' => 'Meja',
                'name'          => 'Meja Makan Kayu Jati',
                'description'   => 'Meja makan dari kayu jati asli yang tahan lama dan elegan.',
                'price'         => 1800000,
                'stock'         => 8,
                'image'         => 'https://images.unsplash.com/photo-1577140917170-285929fb55b7?q=80&w=800',
            ],
            [
                'category_name' => 'Meja',
                'name'          => 'Meja Kopi Kayu Solid',
                'description'   => 'Meja kopi minimalis kayu solid multifungsi, cocok untuk ruang tamu, cafe, maupun samping tempat tidur.',
                'price'         => 650000,
                'stock'         => 14,
                // Gambar dari produk Furnibest di Shopee
                'image'         => 'https://down-id.img.susercontent.com/file/5cd788b7bdf61ed056a014f5e3ece8b0',
            ],

           // ── KURSI ─────────────────────────────────────────────────────────
            [
                'category_name' => 'Kursi',
                'name'          => 'Kursi Kantor Ergonomis',
                'description'   => 'Kursi kantor dengan desain ergonomis untuk kenyamanan maksimal saat bekerja.',
                'price'         => 1200000,
                'stock'         => 15,
                'image'         => 'https://static.jakmall.id/2022/11/images/products/703490/original/yilai-kursi-kantor-office-chair-adjustable-height-cf-032.jpg',
            ],
            [
                'category_name' => 'Kursi',
                'name'          => 'Kursi Santai Scandinavian',
                'description'   => 'Kursi kerja kantor gaya Scandinavian dengan jok kain empuk, sandaran tangan, dan tinggi yang dapat disesuaikan.',
                'price'         => 950000,
                'stock'         => 12,
                // REVISI: Spasi di awal dihapus dan URL diperbarui
                'image'         => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=800',
            ],

            // ... (Lemari, Tempat Tidur, Rak, Laci/Kabinet tetap sama) ...

            // ── LEMARI ────────────────────────────────────────────────────────
            [
                'category_name' => 'Lemari',
                'name'          => 'Lemari Pakaian 5 Pintu',
                'description'   => 'Lemari pakaian luas dengan desain fungsional.',
                'price'         => 2200000,
                'stock'         => 12,
                'image'         => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=800',
            ],
            [
                'category_name' => 'Lemari',
                'name'          => 'Lemari Pakaian Sliding',
                'description'   => 'Lemari pakaian pintu geser ukuran 150 cm, dilengkapi laci tersembunyi dan rak yang dapat disesuaikan. Material particle board + MDF dengan laminasi PVC.',
                'price'         => 3100000,
                'stock'         => 6,
                // Gambar dari produk Pro Design Vegas di prodesign.id
                'image'         => 'https://prodesign.id/assets/upload/product/59c823a0e53945313d84c1b36ead738a1.jpg',
            ],

            // ── TEMPAT TIDUR ──────────────────────────────────────────────────
            [
                'category_name' => 'Tempat tidur',
                'name'          => 'Tempat Tidur King Size',
                'description'   => 'Tempat tidur ukuran king dengan rangka kayu solid.',
                'price'         => 3500000,
                'stock'         => 5,
                'image'         => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=800',
            ],
            [
                'category_name' => 'Tempat tidur',
                'name'          => 'Tempat Tidur Minimalis Single',
                'description'   => 'Tempat tidur kayu minimalis ukuran single dengan desain simpel dan elegan.',
                'price'         => 2800000,
                'stock'         => 9,
                'image'         => 'https://images.unsplash.com/photo-1588046130717-0eb0c9a3ba15?q=80&w=800',
            ],

            // ── RAK ───────────────────────────────────────────────────────────
            [
                'category_name' => 'Rak',
                'name'          => 'Rak Buku Minimalis',
                'description'   => 'Rak buku dengan desain minimalis dan multifungsi.',
                'price'         => 800000,
                'stock'         => 20,
                'image'         => 'https://images.unsplash.com/photo-1594620302200-9a762244a156?q=80&w=800',
            ],
            [
                'category_name' => 'Rak',
                'name'          => 'Rak TV Lowboard',
                'description'   => 'Rak TV lowboard modern untuk ruang tamu dengan sentuhan minimalis.',
                'price'         => 1750000,
                'stock'         => 11,
                // Gambar dari produk Heim Studio RUYA Meja TV di Dekoruma
                'image'         => 'https://media.dekoruma.com/catalogue/NRA-478112.jpg?width=476&height=279&fit=crop',
            ],

            // ── LACI / KABINET ────────────────────────────────────────────────
            [
                'category_name' => 'Laci/Kabinet',
                'name'          => 'Kabinet Dapur Multifungsi',
                'description'   => 'Kabinet dapur tahan air untuk menyimpan peralatan masak.',
                'price'         => 1500000,
                'stock'         => 10,
                'image'         => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'category_name' => 'Laci/Kabinet',
                'name'          => 'Sideboard Minimalis',
                'description'   => 'Sideboard minimalis dengan laci dan rak untuk ruang keluarga.',
                'price'         => 1350000,
                'stock'         => 13,
                'image'         => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&q=80&w=800',
            ],

           
            // ── DEKORASI ──────────────────────────────────────────────────────
            [
                'category_name' => 'Dekorasi',
                'name'          => 'Vas Bunga Keramik',
                'description'   => 'Vas bunga dari keramik dengan desain elegan.',
                'price'         => 300000,
                'stock'         => 25,
                'image'         => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?q=80&w=800',
            ],
            [
                'category_name' => 'Dekorasi',
                'name'          => 'Dekorasi Dinding Modern',
                'description'   => 'Dekorasi dinding modern dengan tampilan abstrak untuk mempercantik ruangan.',
                'price'         => 425000,
                'stock'         => 30,
                // REVISI: URL diperbarui agar lebih fokus ke dekorasi dinding
                'image'         => 'https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?q=80&w=800',
            ],

        ];

        foreach ($products as $productData) {
            $category = \App\Models\Category::where('name', trim($productData['category_name']))->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name'        => $productData['name'],
                    'description' => $productData['description'],
                    'price'       => $productData['price'],
                    'stock'       => $productData['stock'],
                    'image'       => $productData['image'],
                ]);
            } else {
                $this->command->error("Kategori tidak ditemukan: " . $productData['category_name']);
            }
        }
    }
}