<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'code' => strtoupper(fake()->bothify('??##??##??')),
            'category' => fake()->word,
            'image' => fake()->imageUrl(),
            'sellingPrice' => fake()->randomFloat(2, 0, 1000),
            'specialPrice' => fake()->randomFloat(2, 0, 1000),
            'status' => "draft",
            'isDeliveryAvailable' => fake()->boolean(),
        ];
    }
}
