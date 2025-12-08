<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'category';
    protected $with = ['news'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Category::generateUniqueSlug($category->name);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Category::generateUniqueSlug($category->name, $category->id);
            }
        });
    }

    /**
     * Generate unique slug for category
     */
    public static function generateUniqueSlug($name, $id = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada
        while (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke news
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'category_id');
    }

    // Relasi ke titip tulisan
    public function titipTulisans(): HasMany
    {
        return $this->hasMany(TitipTulisan::class, 'category_id');
    }
}
