<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
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
        $users = User::all('id')->random();
        $courses = Course::all('id')->random();

        return [
            'user_id' => $users->id,
            'course_id' => $courses->id,
            'title' => fake()->sentence,
            'brief' => fake()->paragraph,
        ];
    }
}
