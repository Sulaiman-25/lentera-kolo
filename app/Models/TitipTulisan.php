<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TitipTulisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'judul',
        'isi',
        'category_id',
        'image',
        'status',
        'views', // Pastikan ini ada
        'slug'   // Pastikan ini ada
    ];

    protected $casts = [
        'views' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($titip) {
            $titip->slug = TitipTulisan::generateUniqueSlug($titip->judul);
        });

        static::updating(function ($titip) {
            if ($titip->isDirty('judul')) {
                $titip->slug = TitipTulisan::generateUniqueSlug($titip->judul, $titip->id);
            }
        });
    }

    /**
     * Generate unique slug for titip tulisan
     */
    public static function generateUniqueSlug($judul, $id = null)
    {
        $slug = Str::slug($judul);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada
        while (TitipTulisan::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'titip_tulisan_id');
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
