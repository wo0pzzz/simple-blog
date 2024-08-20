<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data['post_id'] = $request->post_id;
        $data['author_id'] = Auth::user()->id;
        $data['comment'] = $request->comment;

        $validate = Validator::make($data, [
            'post_id' => 'required',
            'author_id' => 'required',
            'comment' => 'required|string'
        ]);

        if ($validate->fails()) {
            return redirect()->route('post.index', $data['post_id'])
                ->with('error', 'Comment not created.');
        }

        Comment::create($data);

        return redirect()->route('post.index', $data['post_id'])
            ->with('success', 'Comment created successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $comment = Comment::find($id);

        if ($comment && $comment->author_id == Auth::user()->id) {
            $comment->delete();

            return redirect()->route('post.index', $comment->post_id)
                ->with('success', 'Comment deleted successfully');
        }

        return redirect()->route('post.index', $comment->post_id)
            ->with('error', 'Comment not deleted.');
    }
}
