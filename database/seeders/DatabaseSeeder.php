<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            userSeeder::class,
            adminSeeder::class,
            customerSeeder::class,
            categorySeeder::class,
            productSeeder::class,
        ]);
    }
}
