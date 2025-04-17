<?php

namespace App\Policies;

use App\Enums\Enums\ArticlePermissionsEnum;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{

    public function manageArticles(User $user): Response
    {
        return $user->hasAnyPermission([
            ArticlePermissionsEnum::ALLOW_CREATE,
            ArticlePermissionsEnum::ALLOW_UPDATE,
            ArticlePermissionsEnum::ALLOW_DELETE,
            ArticlePermissionsEnum::ALLOW_UPDATE_ANY,
            ArticlePermissionsEnum::ALLOW_DELETE_ANY,
        ]) ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([
            ArticlePermissionsEnum::ALLOW_CREATE,
            ArticlePermissionsEnum::ALLOW_UPDATE_ANY,
            ArticlePermissionsEnum::ALLOW_DELETE_ANY,
        ]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {

        if ($user->hasPermission(ArticlePermissionsEnum::DENY_CREATE)) {
            return Response::denyAsNotFound();
        }

        return $user->hasPermission(ArticlePermissionsEnum::ALLOW_CREATE) ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): Response
    {

        if ($user->didNotWrite($article)) {

            if ($user->hasPermission(ArticlePermissionsEnum::DENY_UPDATE_ANY)) {
                return Response::denyAsNotFound();
            }

            return $user->hasPermission(ArticlePermissionsEnum::ALLOW_UPDATE_ANY) ?
                Response::allow() :
                Response::denyAsNotFound();
        }

        return $user->hasPermission(ArticlePermissionsEnum::ALLOW_UPDATE) ?
            Response::allow() :
            Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): Response
    {

        if ($user->didNotWrite($article)) {

            if ($user->hasPermission(ArticlePermissionsEnum::DENY_DELETE_ANY)) {
                return Response::denyAsNotFound();
            }

            return $user->hasPermission(ArticlePermissionsEnum::ALLOW_DELETE_ANY) ?
                Response::allow() :
                Response::denyAsNotFound();
        }

        return $user->hasPermission(ArticlePermissionsEnum::ALLOW_DELETE) ?
            Response::allow() :
            Response::denyAsNotFound();
    }
}
