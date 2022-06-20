<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition()
    {
        return [
            'house_id' => 1,
            'customer_id' => 1,
            'number' => $this->faker->randomNumber(6),
            'date' => $this->faker->date(),
            'subtotal' => 0,
            'additional_cost' => $this->faker->numberBetween(100, 500),
            'discount' => $this->faker->numberBetween(100, 500),
            'total' => 0,
            'paid' => 0,
        ];
    }
}
