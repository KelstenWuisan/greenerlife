<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence, // Use $this->faker
            'slug' => $this->faker->slug, // Use $this->faker
            'body' => $this->faker->paragraph, // Use $this->faker
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id,  // Using null safe operator
            'user_id' => \App\Models\User::inRandomOrder()->first()?->id,  // Using null safe operator
            'image' => $this->faker->imageUrl(), // Use $this->faker
            'location' => $this->faker->city,
        ];
    }
}
