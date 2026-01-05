<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    
    public function toggleLike(Article $article)
    {
        $userId = auth()->id();
        $like = $article->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete(); 
        } else {
            $article->likes()->create(['user_id' => $userId]); 
        }

        return back();
    }

    
    public function storeComment(Request $request, Article $article)
    {
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}