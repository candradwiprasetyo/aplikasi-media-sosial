<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $comment = new Comment();
        $comment->post_id = $postId;
        $user = Auth::user();
        $comment->user_id = $user->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('posts.show', $postId);
    }

}
