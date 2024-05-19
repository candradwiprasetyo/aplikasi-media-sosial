<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="w-full h-screen md:flex">
      
      <div class="flex-1 content-center flex items-center px-8 md:px-0">
        <div class="w-96 mx-auto font-medium py-8 md:py-0">
          <div>
          <div class="text-lg font-extrabold">Selamat datang di</div>
            <div class="text-xl md:text-2xl mb-5">Aplikasi Media Sosial</div>
                @if ($errors->any())
                    <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <form action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="border border-gray-300 w-full rounded py-1 px-3">
                    </div>
                    <div class="mt-4 mb-2">
                        <label for="pwd">Password</label>
                        <input type="password" id="password" name="password" required class="border border-gray-300 w-full rounded py-1 px-3">
                    </div>
                    <button type="submit" class="p-3 bg-green-500 rounded text-white font-bold">Masuk</button>
                    <p class="mt-4">
                        Tidak memiliki akun? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar di sini</a>.
                    </p>
                </form>
          </div>
        </div>
      </div>
      <div class="flex-1 bg-cover bg-no-repeat bg-top bg-right content-center flex items-center w-full min-h-[200px]" style="background-image: url({{ asset('storage/images/banner-2.png') }})"></div>
    </div>
</body>
</html>
