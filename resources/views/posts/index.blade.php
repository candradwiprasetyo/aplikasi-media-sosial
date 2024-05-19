@extends('layouts.app')

@section('content')
    <h1>All Posts</h1>
    <!-- <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a> -->

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="video">Video</label>
            <input type="file" name="video" id="video" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>

    @foreach ($posts as $post)
        <div class="bg-white mb-5 p-3 rounded">
            <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->content }}</a></h2>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="image" width="100">
            @endif
            @if($post->video)
                <video src="{{ asset('storage/' . $post->video) }}" controls></video>
            @endif
            <p>{{ $post->created_at->diffForHumans() }}</p>
            @if($user->id == $post->user_id)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Anda yakin ingin menghapus post ini?')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Delete</button>
                </form>
            @endcan
            <br>
            <p>{{ $post->likes->count() }} Likes</p>
            <br>
            <!-- <form action="{{ route('likes.store', $post->id) }}" method="POST">
                @csrf
                <button type="submit">Like</button>
            </form> -->
            @if ($post->isLikedBy(Auth::user()->id))
                <form action="{{ route('likes.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Unlike</button>
                </form>
            @else
                <form action="{{ route('likes.store', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Like</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection