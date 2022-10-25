<?php

namespace Database\Seeders;

use App\Models\Setup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setup::factory()->create([
            'description' => 'Medical Clinic',
            'table' => 'medical'
        ]);

        Setup::factory()->create([
            'description' => 'Job Site',
            'table' => 'jobsites'
        ]);

        Setup::factory()->create([
            'description' => 'Location',
            'table' => 'location'
        ]);

        Setup::factory()->create([
            'description' => 'Branches',
            'table' => 'branches'
        ]);

        Setup::factory()->create([
            'description' => 'Principals',
            'table' => 'principals'
        ]);
    }
}
