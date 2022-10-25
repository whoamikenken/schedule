<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //Create Location
        Location::factory()->create([
            'code' => 'MNL',
            'description' => 'Manila',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Location::factory()->create([
            'code' => 'DAV',
            'description' => 'Davao',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Location::factory()->create([
            'code' => 'CBU',
            'description' => 'Cebu',
            'modified_by' => 1,
            'created_by' => 1,
        ]);
    
    }
}
