<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'userName' => 'arefin101',
            'email' => 'arefink910@gmail.com',
            'userType' => 'Admin',
            'password' => Hash::make('1111'),
        ]);
        DB::table('users')->insert([
            'userName' => 'sandip101',
            'email' => 'sandip@gmail.com',
            'userType' => 'Admin',
            'password' => Hash::make('1111'),
        ]);
        DB::table('users')->insert([
            'userName' => 'rafiq101',
            'email' => 'rafiquzzaman910@gmail.com',
            'userType' => 'Customer',
            'password' => Hash::make('1111'),
        ]);
        DB::table('users')->insert([
            'userName' => 'bipasa101',
            'email' => 'bipasa0@gmail.com',
            'userType' => 'Customer',
            'password' => Hash::make('1111'),
        ]);
    }
}
