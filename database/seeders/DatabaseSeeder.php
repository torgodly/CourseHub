<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'type' => 'admin',
        ]);

        $trainer = User::factory()->create([
            'name' => 'Test Trainer',
            'email' => 'trainer@trainer.com',
            'type' => 'trainer'
        ]);

        $users = User::factory(10)->create([
            'type' => 'user',
        ]);


        Course::factory(10)->create(
            [
                'trainer_id' => $trainer->id,
            ]
        )->each(function ($course) use ($users) {
            Section::factory(10)->create(['course_id' => $course->id]);
            foreach ($users as $user) {
                Enrollment::factory()->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        });




    }
}
