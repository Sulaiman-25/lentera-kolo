<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'news';
    protected $with = ['author'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = News::generateUniqueSlug($news->title);
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = News::generateUniqueSlug($news->title, $news->id);
            }
        });
    }

    /**
     * Generate unique slug for news
     */
    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada
        while (News::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'news_id');
    }

// app/Models/News.php

public function comments()
{
    return $this->morphMany(Comment::class, 'commentable')->latest();
}

// Untuk menghitung jumlah komentar
public function getCommentsCountAttribute()
{
    return $this->comments()->count();
}
}
