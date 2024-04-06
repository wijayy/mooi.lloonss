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
            "nama" => fake()->sentence(2),
            'slug' => fake()->slug(),
            "harga" => mt_rand(50, 250) * 1000,
            "deskripsi" => fake()->paragraph(),
            "image1" => "img/1.png",
            "image2" => "img/2.png",
            "image3" => "img/3.png",
            "image4" => "img/4.png",
            "image5" => "img/5.png",
            "product_category_id" => mt_rand(1, 2),
        ];
    }
}