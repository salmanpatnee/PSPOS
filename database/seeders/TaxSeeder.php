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
                'name'          => 'VAT',
                'rate'          => 5,
                'is_group'      => 0,
                'status'        => 1,
                'created_by'    => 1

            ],
            [
                'name'          => 'Salex Tax',
                'rate'          => 10,
                'is_group'      => 1,
                'status'        => 1,
                'created_by'    => 1
            ]
        ];

        Tax::insert($taxes);
    }
}
