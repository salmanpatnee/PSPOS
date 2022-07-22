<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $purchae_price = $this->faker->numberBetween(5, 100);
        $selling_price = $purchae_price + (($purchae_price * 14) / 100);

        return [
            'category_id'            => $this->faker->numberBetween(1, 10),
            'brand_id'               => $this->faker->numberBetween(1, 10),
            'product_id'             => $this->faker->unique()->randomNumber(),
            'name'                   => $this->faker->unique()->word,
            'stock_threshold'        => $this->faker->numberBetween(3, 10),
            'default_purchase_price' => $purchae_price,
            'default_selling_price'  => $selling_price,
            'created_by'             => 1,
        ];
    }
}
