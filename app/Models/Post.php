<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'featured_image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}

public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}

public function likesCount()
{
    return $this->likes()->where('liked', true)->count();
}

public function dislikesCount()
{
    return $this->likes()->where('liked', false)->count();
}

public function likedBy(User $user)
{
    return $this->likes()->where('user_id', $user->id)->first();
}
}
