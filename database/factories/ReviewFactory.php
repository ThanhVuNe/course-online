<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all('id')->random(),
            'course_id' => Course::all('id')->random(),
            'rating' => fake()->randomFloat(1, 1.0, 5.0),
            'review' => fake()->text(500),
        ];
    }
}
