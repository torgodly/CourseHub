<?php

namespace Database\Factories;

use App\Enum\EnrollmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'course_id' => 1,
            'status' => $this->faker->randomElement(EnrollmentStatus::cases()),
            'price' => 10,
            'completed_at' => null,
            'enrolled_at' => now()
        ];
    }
}
