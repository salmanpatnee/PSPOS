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
            RoleAndPermissionSeeder::class,
            CategorySeeder::class,
            CurrencySeeder::class,
            BusinessSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
        ]);
    }
}
