@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            {{ $user->email }}
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="border border-gray-300 rounded-md px-4 py-2 w-full">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="photo" class="block text-gray-700 font-semibold mb-2">Foto profil</label>
            @if($user->profile_photo)
              <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="Current Profile Photo" class="mt-1 w-24 h-24 rounded-lg object-cover">
            @endif
            <input type="file" name="photo" id="photo" class="border border-gray-300 rounded-md px-4 py-2 w-full">
            @error('photo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 font-semibold mb-2">Biodata</label>
            <textarea name="bio" id="bio" class="border border-gray-300 rounded-md px-4 py-2 w-full">{{ $user->bio }}</textarea>
            @error('bio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="interests" class="block text-gray-700 font-semibold mb-2">Minat</label>
            <textarea name="interests" id="interests" class="border border-gray-300 rounded-md px-4 py-2 w-full">{{ $user->interests }}</textarea>
            @error('interests')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Simpan Profil</button>
        </div>
    </form>
</div>
@endsection
