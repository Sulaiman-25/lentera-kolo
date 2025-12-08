<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Models\TitipTulisan;
use App\Models\Category;
use Illuminate\Support\Str;

class GenerateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for News...');
        $newsCount = 0;
        foreach (News::all() as $news) {
            $news->slug = News::generateUniqueSlug($news->title, $news->id);
            $news->save();
            $newsCount++;
        }
        $this->info("Generated {$newsCount} slugs for News");

        $this->info('Generating slugs for TitipTulisan...');
        $titipCount = 0;
        foreach (TitipTulisan::all() as $titip) {
            $titip->slug = TitipTulisan::generateUniqueSlug($titip->judul, $titip->id);
            $titip->save();
            $titipCount++;
        }
        $this->info("Generated {$titipCount} slugs for TitipTulisan");

        $this->info('Generating slugs for Category...');
        $categoryCount = 0;
        foreach (Category::all() as $category) {
            $category->slug = Category::generateUniqueSlug($category->name, $category->id);
            $category->save();
            $categoryCount++;
        }
        $this->info("Generated {$categoryCount} slugs for Category");

        $this->info('All slugs generated successfully!');
    }
}
