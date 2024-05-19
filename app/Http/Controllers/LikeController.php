<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store($postId)
    {
        $user = Auth::user();
        $userId = $user->id;
        $existingLike = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($existingLike) {
            return redirect()->route('posts.index')->with('error', 'You have already liked this post!');
        }

        $like = new Like();
        $like->user_id = $userId;
        $like->post_id = $postId;
        $like->save();

        return redirect()->route('posts.index')->with('success', 'Post liked successfully!');
    }

    public function destroy($postId)
    {
        $user = Auth::user();
        $like = Like::where('post_id', $postId)->where('user_id', $user->id)->first();
        $like->delete();

        return redirect()->back();
    }

}
