<h2>{{ $post->content }}</h2>
@if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="image">
@endif
@if($post->video)
    <video src="{{ asset('storage/' . $post->video) }}" controls></video>
@endif

@foreach($post->comments as $comment)
    <p>{{ $comment->content }}</p>
@endforeach

<form action="{{ route('comments.store', $post->id) }}" method="POST">
    @csrf
    <textarea name="content" placeholder="Write a comment..."></textarea>
    <button type="submit">Comment</button>
</form>
