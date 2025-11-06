<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ads>
 */
class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>fake()->sentence(),
            'category_id' =>Category::factory(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(1000,10000),
            'location' => $this->faker->sentence(),
            'user_id' => User::factory(),
            'image' => 'default.png',
        ];
    }
}
