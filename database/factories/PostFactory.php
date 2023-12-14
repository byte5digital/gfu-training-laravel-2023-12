<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => User::inRandomOrder()->limit(1)->first()->getKey(),
            'title'     => fake()->text(20),
            'text'      => fake()->paragraphs(rand(3, 10), true),
            'tags'      => implode(fake()->words(rand(0, 5)), ', '),
        ];
    }
}
