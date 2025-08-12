<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory(1)->create([
            'username' => 'qsd',
            'password' => 'qsd',
            'role' => 'admin'
        ]);
        Category::factory(9)->create();

        $tags = Tag::factory(5)->create();
        Post::factory(15)->has(Comment::factory(5))->hasAttached($tags)->create();

    }
}
