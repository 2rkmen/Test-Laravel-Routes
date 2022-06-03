<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Post::truncate();
        Category::truncate();

        $user = User::factory()->create();

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);
        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);
        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => "my family post",
            'slug' => "my-family-post",
            'excerpt' => "excerpt family post",
            'body' => "family lorem ipsum dolar sit ames",
        ]);
        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => "my work post",
            'slug' => "my-work-post",
            'excerpt' => "excerpt work post",
            'body' => "work lorem ipsum dolar sit ames",
        ]);
        Post::create([
            'user_id' => $user->id,
            'category_id' => $hobbies->id,
            'title' => "my hobby post",
            'slug' => "my-hobby-post",
            'excerpt' => "excerpt hobby post",
            'body' => "hobby lorem ipsum dolar sit ames",
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
