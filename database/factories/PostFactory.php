<?php

namespace Database\Factories;

use Str; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>fake()->sentence(),
            'sub_title' => fake() -> sentence(),
            'description' => fake() -> paragraph(),
            'slug' => Str::slug(fake()->sentence()),
        ];
    }
}
