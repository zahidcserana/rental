<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // DB::table('customers')->truncate();
        // DB::table('invoice_items')->truncate();
        // DB::table('invoices')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();

        $this->call([
            // CustomerSeeder::class,
            // InvoiceSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
