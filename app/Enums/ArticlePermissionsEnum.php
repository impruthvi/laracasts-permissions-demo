<?php

namespace App\Enums\Enums;

enum ArticlePermissionsEnum: string
{
    case ALLOW_CREATE = 'article:create';
    case ALLOW_DELETE = 'article:delete';
    case ALLOW_DELETE_ANY = 'article:delete-any';
    case ALLOW_UPDATE = 'article:update';
    case ALLOW_UPDATE_ANY = 'article:update-any';


    case DENY_CREATE = 'article:create:deny';
    case DENY_DELETE_ANY = 'article:delete-any:deny';
    case DENY_UPDATE_ANY = 'article:update-any:deny';
}
