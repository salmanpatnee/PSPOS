<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Abbot', 'Alfalah', 'Alshifa', 'Apex', 'Asian', 'Atco', 'B&B', 'Barret', 'BD', 'Biocos', 'Bisconi', 'LU', 'Bosh', 'Cadbury', 'Care'];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand
            ]);
        }
    }
}
