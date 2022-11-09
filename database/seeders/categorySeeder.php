<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'categoryId' => 1,
            'categoryName' => 'Tshirt',
        ]);
        DB::table('categories')->insert([
            'categoryId' => 2,
            'categoryName' => 'Electronic',
        ]);
    }
}
