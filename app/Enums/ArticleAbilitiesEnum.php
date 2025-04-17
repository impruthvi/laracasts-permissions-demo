<?php

namespace App\Enums;

enum ArticleAbilitiesEnum: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
