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
        Gate::define('admin-access', function(User $user) {
            return $user->is_admin;
        });

        Gate::define('manage-articles', function(User $user, Article $article) {
            return Gate::allows('admin-access') || $user->id === $article->author_id;
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
