<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $house1 = House::factory()->create([
            'id' => 1,
            'name' => 'Mirpur House',
        ]);
        $sadmin = User::factory()->create([
            'id' => 1,
            'name' => 'Analytical Journey',
            'email' => 'admin@analytical.com',
            'mobile' => '01708887754',
            'password' => Hash::make('analyt$cal'),
            'type' => User::TYPE_ADMIN_SUPER,
            'house_id' => 1
        ]);
        $admin1 = User::factory()->create([
            'id' => 2,
            'name' => 'Analytical Admin',
            'email' => 'admin@admin.com',
            'type' => User::TYPE_ADMIN,
            'house_id' => 1
        ]);
        $member1 = User::factory()->create([
            'id' => 3,
            'email' => 'member@admin.com',
            'type' => User::TYPE_MEMBER,
            'house_id' => 1
        ]);


        $house2 = House::factory()->create([
            'id' => 2,
            'name' => 'Dhaka House',
        ]);
        $admin2 = User::factory()->create([
            'id' => 4,
            'name' => 'Analytical Rental',
            'email' => 'rental@admin.com',
            'type' => User::TYPE_ADMIN,
            'house_id' => 2
        ]);
        $member2 = User::factory()->create([
            'id' => 5,
            'email' => 'user@admin.com',
            'type' => User::TYPE_MEMBER,
            'house_id' => 2
        ]);
    }
}
