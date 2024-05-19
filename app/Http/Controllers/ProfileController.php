<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:255',
            'interests' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->profile_photo = $photoPath;
        }

        $user->bio = $request->bio;
        $user->interests = $request->interests;

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Data profile sukses diubah');
    }
}
