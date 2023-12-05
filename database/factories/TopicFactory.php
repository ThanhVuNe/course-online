<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Topic::class;

    public function definition(): array
    {
        $course = Course::all('id')->random();

        return [
            'name' => $this->faker->unique()->word,
            'course_id' => $course->id
        ];
    }
}
