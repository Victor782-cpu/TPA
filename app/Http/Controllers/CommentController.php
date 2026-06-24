<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        if (!auth()->check()) {
            abort(401, 'Você precisa estar logado para comentar.');
        }

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(), 
            'post_id' => $post->id,  
        ]);
        return redirect()->back()->with('success', 'Comentário adicionado!');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'Você não tem permissão para apagar este comentário.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comentário removido com sucesso!');
    }

}