<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        $this->call(RoleSeeder::class);

        //\App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        Category::factory(5)->create();
        Tag::factory(9)->create();
        $this->call(PostsSeeder::class);
    }
}
