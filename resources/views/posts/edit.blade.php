<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block font-medium">Title</label>
                <input type="text" name="title" class="w-full border rounded px-4 py-2 mt-1" value="{{ old('title', $post->title) }}">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Body</label>
                <textarea name="body" rows="6" class="w-full border rounded px-4 py-2 mt-1">{{ old('body', $post->body) }}</textarea>
                @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Current Image</label>
                @if ($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="w-full h-60 object-cover rounded mb-2">
                @endif
                <input type="file" name="featured_image">
                @error('featured_image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
    <label class="block font-medium">Category</label>
    <select name="category_id" class="w-full border rounded px-4 py-2 mt-1">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Post</button>
        </form>
    </div>
</x-app-layout>
