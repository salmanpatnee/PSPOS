<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'business_id' => 1,
                'name' => 'Malir Branch',
                'location_id' => 'PS001',
                'city' => 'Karachi',
                'mobile'    => '03313623653',
                'email' => 'malirbranch@gmail.com'
            ],
            [
                'business_id' => 1,
                'name' => 'Defence Branch',
                'location_id' => 'PS002',
                'city' => 'Karachi',
                'mobile'    => '03353623653',
                'email' => 'defencebranch@gmail.com'
            ],
            [
                'business_id' => 1,
                'name' => 'Saddar Branch',
                'location_id' => 'PS003',
                'city' => 'Karachi',
                'mobile'    => '03013665653',
                'email' => 'saddarbranch@gmail.com'
            ]

        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
