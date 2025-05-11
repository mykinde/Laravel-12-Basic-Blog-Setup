<div x-data="{ open: false }" class="md:hidden p-4 bg-white shadow-md">
    <button @click="open = !open" class="text-gray-800 focus:outline-none">
        ☰ Menu
    </button>
    <div x-show="open" class="mt-2 space-y-2">
        <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600">🏠 Home</a>
        <a href="{{ route('posts.index') }}" class="block text-gray-700 hover:text-blue-600">📝 All Posts</a>
        <!-- Add more links as needed -->
    </div>
</div>


<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Blog Menu</h2>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600">🏠 Home</a></li>
                    <li><a href="{{ route('posts.index') }}" class="block text-gray-700 hover:text-blue-600">📝 All Posts</a></li>
                    <li><a href="#" class="block text-gray-700 hover:text-blue-600">📚 Categories</a></li>
                    <li><a href="#" class="block text-gray-700 hover:text-blue-600">📄 About</a></li>
                    <li><a href="#" class="block text-gray-700 hover:text-blue-600">📬 Contact</a></li>
                </ul>
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Add your existing post view content here -->
            <div class="max-w-4xl mx-auto p-6">
   <h1 class="text-2xl font-bold mb-6">Blog Posts</h1> 
   <form method="GET" action="{{ route('home') }}" class="mb-6">
    <input type="text" name="search" placeholder="Search posts..." class="border px-4 py-2 rounded w-full" value="{{ request('search') }}">
</form>
        
        @foreach ($posts as $post)
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                @if ($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-60 object-cover rounded mb-4">
                @endif
                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                <p class="text-gray-700 mt-2">{{ Str::limit($post->body, 150) }}</p>
                <p class="text-sm text-gray-500 mt-2">By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
            </div>



            <div class="flex items-center gap-4 mt-2">
    <form method="POST" action="{{ route('posts.like', $post) }}">
        @csrf
        <button class="text-green-600 font-bold">👍 {{ $post->likesCount() }}</button>
    </form>

    <form method="POST" action="{{ route('posts.dislike', $post) }}">
        @csrf
        <button class="text-red-600 font-bold">👎 {{ $post->dislikesCount() }}</button>
    </form>
</div>



            @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
        @csrf
        <textarea name="body" rows="2" class="w-full border rounded px-3 py-2" placeholder="Add a comment..."></textarea>
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Comment</button>
    </form>
@endauth



@foreach ($post->comments as $comment)
    <div class="border-t py-2 text-sm text-gray-800">
        <strong>{{ $comment->user->name }}</strong> said:
        <p>{{ $comment->body }}</p>
    </div>
@endforeach



@endforeach
      
  
        {{ $posts->links() }}
    </div>

            {{-- Comments, Likes/Dislikes, etc. 
            @include('partials.comments', ['post' => $post])--}}
        </main>
    </div>
</x-app-layout>


