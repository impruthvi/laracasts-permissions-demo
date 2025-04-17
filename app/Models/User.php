<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions'
    ];

    protected $attributes = [
        'permissions' => '[]',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function wrote(Article $article): bool
    {
        return $this->id === $article->author_id;
    }

    public function didNotWrite(Article $article): bool
    {
        return !$this->wrote($article);
    }

    public function getAllPermissions()
    {
        if (Auth::user()->id === $this->id && Context::hasHidden('permissions')) {
            return Context::getHidden('permissions');
        }

        $groupPermissions = $this->groups()->get()->pluck('permissions')->flatten()->pluck('auth_code');
        $permissions = collect($this->permissions);

        return $groupPermissions->merge($permissions)->unique()->map(function ($permission) {
            return strtolower($permission);
        });
    }

    public function hasPermission($permission): bool
    {
        if ($permission instanceof \BackedEnum) {
            $permission = $permission->value;
        }

        return $this->getAllPermissions()->contains(strtolower($permission));
    }

    public function hasAnyPermission(array $permissions): bool
    {
        $perms = array_map(function ($value) {
            if ($value instanceof \BackedEnum) {
                return $value->value;
            }

            return strtolower($value);
        }, $permissions);

        return $this->getAllPermissions()->intersect($perms)->isNotEmpty();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array',
        ];
    }
}
