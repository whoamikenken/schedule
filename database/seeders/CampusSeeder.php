<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Campus::factory()->create([
            'code' => 'CAL',
            'description' => 'Caloocan',
            'created_by' => 1,
            'color' => 'rgb(234, 255, 5)', 
        ]);

        Campus::factory()->create([
            'code' => 'GES',
            'description' => 'Gensan',
            'color' => 'rgb(234, 255, 5)', 
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'LIP',
            'description' => 'Lipa',
            'color' => 'rgb(0, 255, 25)',
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'CDO',
            'description' => 'Cagayan De Oro',
            'color' => 'rgb(255, 0, 242)', 
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'ALB',
            'description' => 'Alabang',
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'ANG',
            'description' => 'Angeles',
            'color' => 'rgb(255, 0, 21)',
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'BAC',
            'description' => 'Bacoor',
            'color' => 'rgb(255, 255, 255)',
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'BAG', 
            'description' => 'Baguio',
            'color' => 'rgb(75, 0, 255)',
            'created_by' => 1,
        ]);

        Campus::factory()->create([
            'code' => 'CUO',
            'description' => 'Cubao',
            'color' => 'rgb(255, 75, 255)',
            'created_by' => 1,
        ]);
    }
}
