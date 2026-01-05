<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Tambahkan baris ini untuk memberi izin pengisian data
    protected $fillable = ['user_id', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

   public function user() {
    return $this->belongsTo(User::class);
    }
}