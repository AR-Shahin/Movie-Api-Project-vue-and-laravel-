<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 5),
            'name' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->sentence(3)),
            'duration' => rand(1, 3),
            'image' => 'https://picsum.photos/seed/picsum/200/300',
            'description' => $this->faker->text(20)
        ];
    }
}
