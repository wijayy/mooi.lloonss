<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $angka = mt_rand(1, 20);
        $huruf = fake()->randomLetter();
        return [
            "nama" => "balon $huruf $angka",
            "slug" => "balon-$huruf-$angka",
            "stock_category_id" => mt_rand(1, 2),
            "jumlah" => mt_rand(2, 5),
            "product_id" => mt_rand(1, 20),
        ];
    }
}
