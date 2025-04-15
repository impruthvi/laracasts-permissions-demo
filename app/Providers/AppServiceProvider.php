<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('access-admin', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('author');
        });

        Gate::define('manage-articles', function (User $user, Article $article) {
            return ($user->hasRole('admin') || $user->hasRole('editor'))
                || ($user->hasRole('author') && $user->id === $article->author_id);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
