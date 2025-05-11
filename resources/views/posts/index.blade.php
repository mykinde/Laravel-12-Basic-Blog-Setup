<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Your Posts</h1>
            <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">New Post</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        @foreach ($posts as $post)
            <div class="bg-white shadow rounded-lg p-4 mb-4 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $post->created_at->toFormattedDateString() }}</p>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline" onclick="return confirm('Delete post?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
</x-app-layout>
