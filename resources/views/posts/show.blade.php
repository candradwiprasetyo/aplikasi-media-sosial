@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ $post->content }}</h2>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="image">
        @endif
        @if($post->video)
            <video src="{{ asset('storage/' . $post->video) }}" controls></video>
        @endif
        <p>{{ $post->created_at->diffForHumans() }}</p>

        <h3>Comments</h3>

        @if ($comments)
            @foreach ($comments as $comment)
                <p>{{ $comment->content }}</p>
            @endforeach
        @else
          <p>Tidak ada komentar untuk posting ini.</p>
        @endif

        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" placeholder="Write a comment..."></textarea>
            <button type="submit">Comment</button>
        </form>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Kembali</a>

    </div>
@endsection
