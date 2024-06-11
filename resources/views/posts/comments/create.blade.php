
<x-app-layout>
<div class="py-4">
    <div class="container mx-auto px-4">
        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Comment:</label>
                <textarea name="content" id="content" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Add Comment
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>