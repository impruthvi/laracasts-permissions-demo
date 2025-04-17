<?php

namespace App\Http\Controllers;

use App\Enums\ArticleAbilitiesEnum;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::visibleTo(Auth::user())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize(ArticleAbilitiesEnum::CREATE, Article::class);

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCreateRequest $request)
    {
        $request->user()
            ->articles()
            ->create($request->all());

        return redirect()->route('articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize(ArticleAbilitiesEnum::UPDATE, $article);

        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $article->update($request->all());

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize(ArticleAbilitiesEnum::DELETE, $article);

        $article->delete();

        return redirect()->route('articles.index');
    }
}
