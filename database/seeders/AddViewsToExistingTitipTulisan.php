<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TitipTulisan;

class AddViewsToExistingTitipTulisan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update semua titip tulisan yang ada untuk menambahkan views = 0
        TitipTulisan::whereNull('views')->update(['views' => 0]);

        // Update semua titip tulisan yang ada untuk generate slug jika belum ada
        TitipTulisan::whereNull('slug')->each(function ($titip) {
            $titip->slug = TitipTulisan::generateUniqueSlug($titip->judul, $titip->id);
            $titip->save();
        });

        $this->command->info('Views and slugs updated for existing TitipTulisan records.');
    }
}
