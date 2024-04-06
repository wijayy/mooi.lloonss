<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryOption>
 */
class DeliveryOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => mt_rand(1, 10),
            "delivery_id" => mt_rand(1, 3),
            "slug" => fake()->slug(),
        ];
    }
}
