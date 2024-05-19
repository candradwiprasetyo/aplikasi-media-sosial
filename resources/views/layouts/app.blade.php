<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a class="text-xl font-bold" href="/profile">
                        @if (Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" style="width: 40px; height: 40px; border-radius: 50%;">
                        
                        @endif
                    </a>
                    <span class="pl-6 font-bold text-lg">Selamat datang, {{ Auth::user()->name }}</span>
                </div>
                <div class="flex space-x-8 items-center text-lg">
                    @guest
                        <a class="text-gray-600 hover:text-gray-800" href="{{ route('login') }}">Login</a>
                    @else
                        <a class="text-gray-600 hover:text-gray-800" href="{{ route('posts.index') }}">Post</a>
                        <a class="text-gray-600 hover:text-gray-800" href="{{ route('profile.show') }}">Profil</a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="cursor-pointer bg-red-500 py-1 px-3 rounded text-white font-bold text-base" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>
</body>
</html>
