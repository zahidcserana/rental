<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        $sadmin = User::factory()->create([
            'id' => 1,
            'name' => 'Analytical Journey',
            'email' => 'admin@analytical.com',
            'mobile' => '01708887754',
            'password' => Hash::make('analyt$cal'),
//            'observe' => Carbon::now()->addMonths(12),
            'type' => User::TYPE_ADMIN_SUPER,
            'house_id' => 1
        ]);

        $creator = User::factory()->create([
            'id' => 2,
            'name' => 'Analytical Admin',
            'email' => 'admin@admin.com',
            'type' => User::TYPE_ADMIN,
//            'observe' => Carbon::now()->addMonths(2),
            'house_id' => 1
        ]);
        $member1 = User::factory()->create([
            'id' => 3,
            'email' => 'member@admin.com',
            'type' => User::TYPE_MEMBER,
//            'observe' => Carbon::now()->addMonths(2),
            'house_id' => 1
        ]);

        $admin = User::factory()->create([
            'id' => 4,
            'name' => 'Analytical Rental',
            'email' => 'rental@admin.com',
//            'observe' => Carbon::now()->addMonths(1),
            'type' => User::TYPE_ADMIN,
            'house_id' => 2
        ]);
        $member2 = User::factory()->create([
            'id' => 5,
            'email' => 'user@admin.com',
            'type' => User::TYPE_MEMBER,
//            'observe' => Carbon::now()->addMonths(2),
            'house_id' => 2
        ]);
    }
}
