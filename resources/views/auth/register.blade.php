<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
        <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div>
        <label for="profile_photo">Profile Photo:</label>
        <input type="file" id="profile_photo" name="profile_photo">
    </div>

    <div>
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"></textarea>
    </div>

    <div>
        <label for="interests">Interests:</label>
        <textarea id="interests" name="interests"></textarea>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
