<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom di tabel products untuk diisi
    protected $guarded = [];

    // Relasi ke tabel Category (opsional jika Anda membuat fitur kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}