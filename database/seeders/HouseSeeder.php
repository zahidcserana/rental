<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Flat;
use App\Models\House;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::factory()
            ->has(
                Customer::factory()
                    ->count(5)
                    ->has(
                        Invoice::factory()
                            ->count(3)
                            ->has(
                                InvoiceItem::factory()
                                    ->count(2)
                            )
                    )
            )
            ->has(
                Flat::factory()
                    ->count(5),
            )
            ->create([
                'id' => 1,
                'name' => 'Mirpur House',
            ]);

        House::factory()
            ->has(
                Customer::factory()
                    ->count(5)
                    ->has(
                        Invoice::factory()
                            ->count(3)
                            ->has(
                                InvoiceItem::factory()
                                    ->count(2)
                            )
                    )
            )
            ->has(
                Flat::factory()
                    ->count(5),
            )
            ->create([
                'id' => 2,
                'name' => 'Dhaka House',
            ]);

    }
}
