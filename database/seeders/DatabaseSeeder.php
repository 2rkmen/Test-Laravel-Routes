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
//truncate не нужен если запускаешь php artisan migrate:fresh --seed

        $user = User::factory()->create([
            'name' => 'Lelya Matveeva'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
        Post::factory()->create();
    }
}
