<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Permission::insert([
            ['auth_code' => 'article:create', 'description' => 'Create article'],
            ['auth_code' => 'article:update', 'description' => 'Update article'],
            ['auth_code' => 'article:update-any', 'description' => 'Update any article'],
            ['auth_code' => 'article:delete', 'description' => 'Delete article'],
            ['auth_code' => 'article:delete-any', 'description' => 'Delete any article'],
            ['auth_code' => 'user:create', 'description' => 'Create user'],
            ['auth_code' => 'permission:create', 'description' => 'Create permission'],
        ]);

        $adminRole = Role::create(['auth_code' => 'admin', 'name' => 'System Administrator']);
        $authorRole = Role::create(['auth_code' => 'author', 'name' => 'Article Author']);
        $editorRole = Role::create(['auth_code' => 'editor', 'name' => 'Article Editor']);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'permissions' => [
                'article:create',
                'article:update-any',
                'article:delete-any',
                'user:create',
                'permission:create',
            ]
        ]);

        // $adminUser->roles()->attach($adminRole);

        $authorUser = User::factory()->create([
            'name' => 'Author',
            'email' => 'author@example.com',
            'permissions' => [
                'article:create',
                'article:update',
                'article:delete',
            ]
        ]);

        // $authorUser->roles()->attach($authorRole);

        $editorUser = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'permissions' => [
                'article:update-any',
                'article:delete-any',
            ]
        ]);

        // $editorUser->roles()->attach($editorRole);

        $authorEditorUser = User::factory()->create([
            'name' => 'Author/Editor',
            'email' => 'ae@example.com',
            'permissions' => [
                'article:create',
                'article:update-any',
                'article:delete-any',
            ]
        ]);

        // $authorEditorUser->roles()->attach($authorRole);
        // $authorEditorUser->roles()->attach($editorRole);

        Article::factory(10)
            ->recycle($authorUser)
            ->create();

        Article::factory(10)
            ->recycle($authorEditorUser)
            ->create();
    }
}
