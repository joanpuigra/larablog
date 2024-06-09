<div class="py-4">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
  <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg">
      <div class="max-w-xl">
        <div class="row">
          @foreach ($posts as $post)
          @if ($posts->isEmpty())
            <p class="text-red-500 font-bold text-3xl">There are no posts.</p>
          @else if ($posts->$post->id == $post->id)
            <article class="rounded-xl shadow-lg">
              <div class="card space-x-2">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
              </div>
        </div>
      </div>
      @endif
      @endforeach
      <div class="row">
        <div class="col-md-8">
          <h2>Comments</h2>
          @foreach($post->comments as $comment)
          @if ($post->comments->isEmpty())
            <p class="text-red-500 font-bold text-3xl">There are no comments.</p>
          @else if ($post->comments->$comment->id == $comment->id)
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $comment->user->name }}</h5>
              <p class="card-text">{{ $comment->content }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>