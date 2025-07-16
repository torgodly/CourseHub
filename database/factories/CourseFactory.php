<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trainer_id' => 1,
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'learn_goals' => json_encode($this->faker->sentences(3)),
            'requirements' => json_encode($this->faker->sentences(2)),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'price' => $this->faker->randomFloat(2, 0, 999),
            'is_free' => $this->faker->boolean,
            'is_approved' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['pending', 'published', 'archived']),
        ];
    }
}
