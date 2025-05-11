<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
   
    use AuthorizesRequests;


    public function publicIndex(Request $request)
    {
        $query = Post::latest();
    
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
        }
    
        $posts = $query->paginate(5);
    
        return view('posts.public', compact('posts'));
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('images', 'public');
        }

        // if above is not working due to storage configuration
       /*  if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $path = $image->store('images', 'public');
            $data['featured_image'] = $path;
        }
        dd($image, $path); */


        $data['user_id'] = Auth::id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);  // For edit/update
        $categories = Category::latest()->get();
        return view('posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('images', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);  // For destroy

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}
