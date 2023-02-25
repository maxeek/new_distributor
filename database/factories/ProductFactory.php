<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition()
    {
        return [
            'category_id' => Category::all()->random()->id,
            'barcode' => $this->faker->randomNumber(6),
            'sku' => $this->faker->randomNumber(6),
            'title' => $this->faker->name,
            'detail' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2),
            'sale_price' => $this->faker->randomFloat(2),
            'stock' => $this->faker->randomNumber(3),
            'alert' => $this->faker->randomNumber(2)
        ];
    }
}
