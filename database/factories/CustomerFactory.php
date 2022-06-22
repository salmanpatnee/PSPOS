<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
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
            'date_of_birth' => $this->faker->date(),
            'address' => $this->faker->address,
            'previous_balance' => 0,
            'total_purchases' => $this->faker->numberBetween(0, 5000),
            'last_purchase' => $this->faker->date(),
        ];
    }
}
