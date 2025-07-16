<?php

namespace Database\Seeders;

use App\Models\Course;
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
        ]);

        Course::factory(2)->create()->each(function ($course) {
            Section::factory(10)->create(['course_id' => $course->id]);
        });


    }
}
