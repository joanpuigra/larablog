<x-app-layout>
  <div class="py-4">
    <div class="max-w-7xl mx-auto">
      <div class="row">
        <article class="rounded-xl shadow-lg">
          <div class="mb-4 text-white text-4xl font-bold flex justify-center rounded-t-xl py-2 bg-red-500 items-center">
            @if ($post === null)
            <h2>Post</h2>
            @else
              <h2>{{ $post->title }}</h2>
            @endif
            </div>
            @if ($post === null)
            <div class="flex flex-row p-4 mb-4 -mt-4 justify-center items-center">
              <p class="text-red-500 font-bold text-3xl">There are no posts.</p>
            </div>
            @else
            <div class="flex flex-row px-4 justify-between items-center">
              <p class="flex italic"><b>Created by:</b><span class="ml-2">{{ $post->author->name }}</span></p>
              <p class="flex italic"><b>Created at:</b><span class="ml-2">{{ $post->created_at }}</span></p>
            </div>
            <div class="p-4 flex-col flex justify-center items-center">
                <p>{{ $post->content }}</p>
            </div>
            <div class="flex justify-center space-x-2 items-center mb-4 p-4">      
            @auth
              <div class="flex justify-center items-center mt-4 bg-red-500 p-4 rounded-xl text-white font-bold">Edit
              </div>
              <div class="flex justify-center items-center mt-4 bg-red-500 p-4 rounded-xl text-white font-bold">
                <a href="{{ route('posts.destroy', $post->id) }}">Delete</a>
              </div>
            @endauth
          </article>
        @endif
      </div>
      <div class="row">
        <div class="rounded-xl shadow-lg">
          <div class="mb-4 text-white text-4xl font-bold flex justify-center rounded-t-xl py-2 bg-red-500 items-center">
            <h2>Comments</h2>
          </div>
            @if ($post === null || $post->comments->isEmpty())
            <div class="flex flex-row p-4 mb-4 -mt-4 justify-center items-center">
              <p class="text-red-500 font-bold text-3xl">There are no comments.</p>
            </div>
            @else
            @foreach($post->comments as $comment)
            <div class="p-4 flex-col flex justify-center items-center">
              <h5 class="card-title">{{ $comment->user->name }}</h5>
              <p class="card-text">{{ $comment->content }}</p>
          </div>
        </div>
        @endforeach
        @endif
    </div>
  </div>
</x-app-layout>