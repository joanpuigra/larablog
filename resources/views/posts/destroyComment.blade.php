<x-app-layout>
  <div class="container">
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
  </div>
</x-app-layout>
