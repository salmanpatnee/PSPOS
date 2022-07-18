<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxes = [
            [
                'name'          => 'GST@5%',
                'rate'          => 5,
                'status'        => 1,
                'created_by'    => 1

            ],
            [
                'name'          => 'VAT@7%',
                'rate'          => 7,
                'status'        => 1,
                'created_by'    => 1
            ]
        ];

        Tax::insert($taxes);
    }
}
