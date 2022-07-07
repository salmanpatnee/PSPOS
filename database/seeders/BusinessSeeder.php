<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $business_settings = [
            "name" => "Pharma Square",
            "currency_id" => 91,
            "owner_id" => 1,
            "currency_symbol_placement" => "before",
        ];

        Business::create($business_settings);
    }
}
