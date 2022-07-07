<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'mobile' => $this->faker->unique()->e164PhoneNumber,
            'address' => $this->faker->address,
            'previous_balance' =>  $this->faker->numberBetween(0, 5000),
            'advance_balance' =>  $this->faker->numberBetween(0, 5000),
        ];
    }
}
