<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'name',
        'email',
        'user_id',
        'commentable_type',
        'commentable_id'
    ];

    protected $with = ['user'];

    /**
     * Dapatkan model parent (News atau TitipTulisan)
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * User yang membuat komentar (jika login)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the display name for comment author
     */
    public function getAuthorNameAttribute(): string
    {
        if ($this->user_id) {
            return $this->user->name ?? 'User';
        }

        return $this->name ?: 'Anonim';
    }

    /**
     * Get the display email for comment author
     */
    public function getAuthorEmailAttribute(): string
    {
        if ($this->user_id) {
            return $this->user->email ?? '';
        }

        return $this->email ?: '';
    }
}
