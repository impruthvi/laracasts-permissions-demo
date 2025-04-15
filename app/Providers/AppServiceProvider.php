<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        Gate::define('manage-articles', function (User $user, Article $article) {
            return ($user->hasRole('admin') || $user->hasRole('editor'))
                || ($user->hasRole('author') && $user->id === $article->author_id);
        });

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasAnyRole([$role])): ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
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
