<?php

namespace Database\Seeders;

use App\Models\Like;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk role
        $this->call([
            CreateRolesSeeder::class,
        ]);

        // Seeder untuk kategori
        $this->call([
            CategorySeeder::class,
        ]);

        // Contoh factory jika ingin generate data besar
        // News::factory(1000)
        //     ->recycle(User::factory(100)->create())
        //     ->recycle(Category::factory(20)->create())
        //     ->create();

        // Like::factory(10000)->create();
    }
}
