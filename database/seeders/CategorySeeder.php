<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data category baru dengan deskripsi lebih lengkap
        $categories = [
            [
                'name' => 'Opini',
            ],
            [
                'name' => 'Pemberdayaan dan Literasi',
            ],
            [
                'name' => 'Potensi Alam dan Budaya',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
