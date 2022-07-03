<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Multicaret\Acquaintances\Traits\CanBeLiked;

class Post extends Model
{
    use HasFactory;
    use CanBeLiked;

    protected $guarded = [];
    protected $appends = ['likesCount', 'isLiked'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likersCount();
    }

    public function getIsLikedAttribute(): bool
    {
        return $this->isLikedBy(Auth()->user());
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->user_id = Auth::id();
        });
    }
}
