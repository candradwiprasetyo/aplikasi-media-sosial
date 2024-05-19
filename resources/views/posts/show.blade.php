@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('posts.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Kembali ke postingan</a>

        <div class="flex font-sans bg-white rounded-lg my-4 p-4">
            @if($post->image)
                <div class="w-2/5 mr-4">
                    
                    <img src="{{ asset('storage/' . $post->image) }}" alt="image" width="100" class="mr-8 inset-0 w-full h-full object-cover" loading="lazy">
                    
                </div>
            @endif
            <div class="w-3/5">
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
                    
                </div>
                <br>
            </div>
        </div>
        <h3 class="mb-2">Komentar</h3>
        <div class="p-3">
            @if ($comments)
                @foreach ($comments as $comment)
                    <div class="flex">
                        <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="User Photo" class="w-6 h-6 rounded-full mr-4">
                        <div class="bg-white mb-4 rounded-lg p-3 text-base flex-grow">
                            <div class="font-bold text-sm">{{ $comment->user->name }}</div>
                            <div class="text-sm">{{ $comment->content }}</div>
                        </div>
                    </div>
                @endforeach
            @else
            <p>Tidak ada komentar untuk posting ini.</p>
            @endif
        </div>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" placeholder="Tulis komentar" class="rounded w-full p-3 bg-white-100 border" required></textarea>
            <button type="submit" class="bg-green-500 hover:bg-red-600 text-white py-2 px-4 rounded-md mb-4">Kirim</button>
        </form>
    </div>
@endsection
