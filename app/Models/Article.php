<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;

class Article extends Model {
    protected $fillable = ['title', 'category', 'content', 'file_path', 'user_id'];
    
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Pastikan parameter $user didefinisikan dengan benar
    public function isLikedBy($user) {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}