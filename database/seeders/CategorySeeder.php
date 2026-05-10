<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sofa',
            'Meja',
            'Kursi',
            'Lemari',
            'Tempat tidur',
            'Rak',
            'Laci/Kabinet',
            'Dekorasi',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}