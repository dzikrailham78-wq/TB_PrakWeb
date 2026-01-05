<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // MENAMBAHKAN: Memberikan data artikel ke semua view (Sidebar)
        View::composer('*', function ($view) {
            $view->with('articles', Article::with(['likes', 'comments'])->latest()->get());
        });
    }
}