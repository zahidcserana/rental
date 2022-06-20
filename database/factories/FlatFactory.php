<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlatFactory extends Factory
{
    public function definition()
    {
        return [
            'house_id' => 1,
            'customer_id' => 1,
            'rent' => $this->faker->numberBetween(10000, 20000),
            'name' => $this->faker->name,
            'slug' => '',
            'description' => '',
            'status' => 'rented',
        ];
    }
}
