<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    public function definition()
    {
        $amount = $this->faker->numberBetween(10000, 20000);

        return [
            'invoice_id' => 1,
            'flat_id' => 1,
            'amount' => $amount,
        ];
    }
}
