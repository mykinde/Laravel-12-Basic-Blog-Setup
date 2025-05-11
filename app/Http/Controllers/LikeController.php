<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $post->likes()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['liked' => true]
        );

        return back()->with('success', 'Liked the post.');
    }

    public function dislike(Post $post)
    {
        $post->likes()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['liked' => false]
        );

        return back()->with('success', 'Disliked the post.');
    }
}
