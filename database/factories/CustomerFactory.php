<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition()
    {
        return [
            'house_id' => 1,
            'name' => $this->faker->name(),
            'nid' => $this->faker->uuid(),
            'mobile' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'advance_balance' => $this->faker->numberBetween(5000, 20000)
        ];
    }
}
