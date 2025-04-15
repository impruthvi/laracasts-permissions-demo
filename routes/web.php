<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'articles' => Article::all(),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'articles' => Article::all(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('articles', ArticlesController::class)->except('show');
    Route::middleware('can:admin-access')
        ->resource('users', UsersController::class)->except(['show', 'create', 'store']);


});

require __DIR__.'/auth.php';
