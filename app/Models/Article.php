<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'is_published',
        'author_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeVisibleTo(Builder $query, $user) {
        if (Gate::allows('viewAny', Article::class)) {
            return $query;
        }

        return $query->where('author_id', $user->id);
    }
}
