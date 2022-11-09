<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'customerId' => 21,
            'userName' => 'rafiq101',
            'email' => 'rafiquzzaman910@gmail.com',
            'phone' => '01911927497',
            'DOB' => '19th April 1994',
            'gender' => 'Male',
            'address' => 'Dhaka Polytechnic Senior Staff Quater 3/J',
            'district' => 'Dhaka',
            'userType' => 'customer',
        ]);
        DB::table('customers')->insert([
            'customerId' => 22,
            'userName' => 'bipasa101',
            'email' => 'bipasa0@gmail.com',
            'phone' => '01911212155',
            'DOB' => '19th April 1994',
            'gender' => 'Female',
            'address' => 'Tangail',
            'district' => 'Tangail',
            'userType' => 'customer',
        ]);
    }
}
