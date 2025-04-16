<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{

    public function manageArticles(User $user): Response
    {
        return $user->hasAnyPermission([
            'article:create',
            'article:update',
            'article:delete',
            'article:update-any',
            'article:delete-any',
        ]) ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['article:create', 'article:update-any', 'article:delete-any']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasPermission('article:create') ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): Response
    {
        if ($user->hasPermission('article:update-any')) {
            return Response::allow();
        }

        return $user->hasPermission('article:update') && $user->id === $article->author_id ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): Response
    {
        if ($user->hasPermission('article:delete-any')) {
            return Response::allow();
        }

        return $user->hasPermission('article:delete') && $user->id === $article->author_id ?
            Response::allow() :
            Response::denyAsNotFound();
    }
}
