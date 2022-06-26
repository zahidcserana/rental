<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'name' => $this->faker->name() . "'s House",
//            'address' => $this->faker->address(),
//            'code' => 'H-' . $this->faker->numberBetween(100, 999)
        ];
    }
}
