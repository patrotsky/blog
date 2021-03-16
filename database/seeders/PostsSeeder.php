<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=Post::factory(12)->create();

        foreach ($posts as $post){
            Image::factory(1)->create([
                'imageable_id'=>$post->id,
                'imageable_type'=>Post::class
            ]);
            //posts_tags. Para cada artículo, relaciona dos etiquetas
            $post->tags()->attach([
                rand(1,4),//Relaciona con una etiqueta_id entre 1 y 4
                rand(5,9),//Relaciona con una etiqueta_id entre 5 y 9
            ]);
        }
    }
}
