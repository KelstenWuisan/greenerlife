<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Challenge;

class ChallengeFactory extends Factory
{
    protected $model = Challenge::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'points' => $this->faker->numberBetween(10, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

