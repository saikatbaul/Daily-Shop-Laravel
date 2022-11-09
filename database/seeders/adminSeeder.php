<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'adminId' => 11,
            'userName' => 'arefin101',
            'name' => 'Arefin',
            'email' => 'arefink910@gmail.com',
            'phone' => '01829747029',
            'address' => 'Dhaka Polytechnic Senior Staff Quater 3/J',
            'district' => 'Dhaka',
            'userType' => 'Admin',
            'picture' => "default.jpg",
        ]);
        DB::table('admins')->insert([
            'adminId' => 12,
            'userName' => 'sandip101',
            'name' => 'Sandip',
            'email' => 'sandip@gmail.com',
            'phone' => '01829747029',
            'address' => 'Nikunja',
            'district' => 'Dhaka',
            'userType' => 'Admin',
            'picture' => "default.jpg",
        ]);
    }
}
