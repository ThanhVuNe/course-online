<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::all('id')->random(),
            'user_id' => User::all('id')->random(),
            'parent_id' => fake()->optional()->numberBetween(1, 10),
            'content' => fake()->paragraph(),
        ];
    }
}
