<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InteractionController;

    Route::get('/', function () {
    return redirect()->route('login');
    });

    Route::middleware(['auth'])->group(function () {
    
    Route::post('/article/{article}/like', [InteractionController::class, 'toggleLike'])->name('like.toggle');
    Route::post('/article/{article}/comment', [InteractionController::class, 'storeComment'])->name('comment.store');

    Route::get('/dashboard', [ArticleController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [ArticleController::class, 'index'])->name('admin.dashboard');

    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/download/{id}', [ArticleController::class, 'download'])->name('articles.download');

    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit'); 
     
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    
    Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [ArticleController::class, 'index'])->name('dashboard');
    
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    
    Route::get('/articles/list', [ArticleController::class, 'list'])->name('articles.list');
    
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/download/{id}', [ArticleController::class, 'download'])->name('articles.download');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});
});


require __DIR__.'/auth.php';