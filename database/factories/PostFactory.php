<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence();
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'extract'=>$this->faker->text(389),
            'body'=>$this->faker->text(3008),
            'status'=>$this->faker->randomElement([1,2]), /*todo: draft, published*/
            'category_id'=>Category::all()->random()->id,//Que escoja entre los ids de las categories que hemos creado
            'user_id'=>User::all()->random()->id//Que escoja entre los ids de las users que hemos creado
        ];
    }
}
