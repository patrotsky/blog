<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(23);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'color'=>$this->faker->randomElement(['red','yellow','green','blue','gray','indigo','purple','pink']),//https://tailwindcss.com/docs/customizing-colors
        ];
    }
}
