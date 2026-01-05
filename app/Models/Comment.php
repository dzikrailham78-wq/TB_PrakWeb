<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Tambahkan baris ini agar komentar bisa disimpan
    protected $fillable = ['body', 'user_id', 'article_id'];

    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function user() {
    return $this->belongsTo(User::class);
    }
}