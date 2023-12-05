<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'introduction' => fake()->paragraph,
            'price' => fake()->randomFloat(2, 10, 100),
            'discount' => fake()->numberBetween(0, 50),
            'category_id'  => function () {
                return Category::factory()->create()->id;
            },
            'instructor_id' => fake()->numberBetween(1, 10),
            'trailer_url' => fake()->url,
            'average_rating' => fake()->randomFloat(1, 1, 5),
            'num_reviews' => fake()->numberBetween(1, 1000),
            'total_students' => fake()->numberBetween(10, 1000),
            'total_lessons' => fake()->numberBetween(5, 50),
            'languages' => fake()->numberBetween(1, 3),
            'level' => fake()->numberBetween(1, 3),
            'poster_url' => fake()->imageUrl(300, 200),
            'total_time' => fake()->randomFloat(2, 1, 100),
            'description' => fake()->paragraphs(3, true),
            'learns_description' => fake()->paragraphs(3, true),
            'requirements_description' => fake()->paragraphs(3, true),
            'is_active' => fake()->randomElement(['true', 'false']),
        ];
    }
}
