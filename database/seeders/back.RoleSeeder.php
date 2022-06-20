<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'slug' => Str::slug('Admin'),
        ]);

        Role::factory()->create([
            'id' => 2,
            'name' => 'Member',
            'slug' => Str::slug('Member'),
        ]);

        Role::factory()->create([
            'id' => 3,
            'name' => 'Super Admin',
            'slug' => Str::slug('Super Admin'),
        ]);
    }
}
