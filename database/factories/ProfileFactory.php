<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::all()->random();

        return [
            'user_id' => $user->id,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'avatar' => 'avatar/defaul.jpg',
            'description' => fake('en_US')->text(200),
        ];
    }
}
