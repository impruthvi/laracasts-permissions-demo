<?php

namespace Database\Seeders;

use App\Models\Article;
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
        $adminRole = Role::create(['auth_code' => 'admin', 'name' => 'System Administrator']);
        $authorRole = Role::create(['auth_code' => 'author', 'name' => 'Article Author']);
        $editorRole = Role::create(['auth_code' => 'editor', 'name' => 'Article Editor']);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $adminUser->roles()->attach($adminRole);

        $authorUser = User::factory()->create([
            'name' => 'Author',
            'email' => 'author@example.com',
        ]);

        $authorUser->roles()->attach($authorRole);

        $editorUser = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
        ]);

        $editorUser->roles()->attach($editorRole);

        $authorEditorUser = User::factory()->create([
            'name' => 'Author/Editor',
            'email' => 'ae@example.com',
        ]);

        $authorEditorUser->roles()->attach($authorRole);
        $authorEditorUser->roles()->attach($editorRole);

        Article::factory(10)
            ->recycle($authorUser)
            ->create();

        Article::factory(10)
            ->recycle($authorEditorUser)
            ->create();
    }
}
