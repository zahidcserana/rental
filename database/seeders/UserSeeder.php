<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sadmin =  User::factory()->create([
            'id' => 1,
            'name' => 'Analytical Journey',
            'email' => 'admin@analytical.com',
            'mobile' => '123',
            'password' => Hash::make('aj$21'),
            'observe' => Carbon::now()->addMonths(12),
            'role_id' => User::ROLE_ADMINISTRATOR,
        ]);

        $admin =  User::factory()->create([
            'id' => 2,
            'name' => 'Analytical Journey',
            'mobile' => '1234',
            'email' => 'cms@analytical.com',
            'observe' => Carbon::now()->addMonths(1),
            'role_id' => User::ROLE_ADMINISTRATOR,
        ]);


        $creator = User::factory()->create([
            'id' => 3,
            'mobile' => '1235',
            'email' => 'creator@cms.com',
            'role_id' => User::ROLE_MEMBER,
            'observe' => Carbon::now()->addDay(),
        ]);

        $member = User::factory()->create([
            'id' => 4,
            'mobile' => '1236',
            'email' => 'member@cms.com',
            'role_id' => User::ROLE_MEMBER,
            'observe' => Carbon::now()->addMonths(2),
        ]);
    }
}
