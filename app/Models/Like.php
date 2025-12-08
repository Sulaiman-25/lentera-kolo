<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function titipTulisan()
    {
        return $this->belongsTo(TitipTulisan::class);
    }

    // Scope untuk News
    public function scopeForNews($query)
    {
        return $query->whereNotNull('news_id');
    }

    // Scope untuk TitipTulisan
    public function scopeForTitipTulisan($query)
    {
        return $query->whereNotNull('titip_tulisan_id');
    }
}
