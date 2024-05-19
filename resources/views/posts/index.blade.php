@extends('layouts.app')

@section('content')
    <!-- <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a> -->

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <textarea name="content" id="content" rows="5" required placeholder="Apa yang anda pikirkan?" class="rounded w-full p-3"></textarea>
        </div>

        <div class="flex justify-between items-center mb-8">
            <div class="flex">
            <div >
                <label for="image">Gambar</label>
                <input type="file" name="image" id="image">
            </div>

            <div >
                <label for="video">Video</label>
                <input type="file" name="video" id="video" >
            </div>
            </div>
            <button type="submit"  class="p-3 bg-green-500 rounded text-white font-bold">Buat postingan</button>
        </div>

    </form>

    @foreach ($posts as $post)
        <div class="flex font-sans bg-white rounded-lg mb-4 p-4">
            @if($post->image)
                <div class="flex-none w-48 relative mr-4">
                    
                    <img src="{{ asset('storage/' . $post->image) }}" alt="image" width="100" class="mr-8 absolute inset-0 w-full h-full object-cover" loading="lazy">
                    
                </div>
            @endif
            <div class="flex-auto">
                <div class="flex flex-wrap">
                <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="User Photo" class="w-8 h-8 rounded-full mr-2">
                <h1 class="flex-auto text-lg font-semibold text-slate-900">
                    {{ $post->user->name }}
                </h1>
                <div class="text-sm font-semibold text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </div>
                <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->content }}</a>
                </div>
                </div>
                <div class="flex space-x-4 mt-6 text-sm font-medium justify-between w-full items-center">
                    <div class="flex items-center gap-2">
                        <span>{{ $post->likes->count() }} like</span>
                        -
                        <p>{{ $post->comments_count }} komentar</p>
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
                    <div class="flex space-x-4">
                        @if($user->id == $post->user_id)
                            <button type="submit" class="bg-yellow-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Edit</button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Anda yakin ingin menghapus post ini?')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Delete</button>
                            </form>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    @endforeach
@endsection