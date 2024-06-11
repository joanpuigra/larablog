<x-app-layout>
  <div class="py-4">
    <div class="max-w-7xl mx-auto">
          <div class="grid border-x-2 border-red-500 grid-cols-2 gap-4 p-4 max-w-full sm:p-6 sm:py-2 sm:rounded-lg">
            @foreach ($posts as $post)
            @if ($posts->isEmpty())
              <p class="text-red-500 font-bold text-3xl">There are no posts.</p>
            @else
              <article class="rounded-xl shadow-lg">
                  <div class="mb-4 p-4 text-white text-4xl font-bold flex flex-row justify-between rounded-xl py-2 bg-red-500 items-center">
                    <h2>{{ $post->title }}</h2>
                    <h3 class="text-xl">Has {{ $post->comments->count() }} comments</h3>
                  </div>
                  <div class="flex flex-row px-4 justify-between items-center">
                    <p class="flex italic"><b>Created by:</b><span class="ml-2">{{ $post->author->name }}</span></p>
                    <p class="flex italic"><b>Created at:</b><span class="ml-2">{{ $post->created_at }}</span></p>
                  </div>  
                  <div class="p-4 flex-col flex justify-center items-center">
                    <p>{{ $post->content }}</p>
                  </div>
                  <div class="flex justify-center space-x-2 items-center mb-4 p-4">
                    <div class="flex justify-center items-center mt-4 bg-red-500 hover:bg-red-700 p-4 rounded-xl text-white font-bold">
                      <a href="{{ route('posts.show', $post->id) }}">View Post</a>
                    </div>
                    @auth
                      <div class="flex justify-center items-center mt-4 bg-red-500 hover:bg-red-700 p-4 rounded-xl text-white font-bold">
                        <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                      </div>
                      <div class="flex justify-center items-center mt-4 bg-red-500 hover:bg-red-700 p-4 rounded-xl text-white font-bold">
                        <a href="{{ route('posts.destroy', $post->id) }}">Delete</a>
                      </div>
                    @endauth
                  </div>
              </article>
          @endif
          @endforeach
          </div>
          @auth
            <div class="flex self-center mt-2 justify-center items-center">
              <div class="bg-red-500 p-4 rounded-xl text-white font-bold">
                <a href="{{ route('posts.create') }}">Add new post</a>
              </div>
            </div>
          @endauth
          </div>
    </div>
  </div>
</x-app-layout>
