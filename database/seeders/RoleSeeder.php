<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        Role::factory()->create([
            'id' => 2,
            'name' => 'Member',
        ]);
    }
}
