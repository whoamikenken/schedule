<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Branches
        Branch::factory()->create([
            'code' => '001',
            'description' => 'Manila',
            'color' => 'rgb(255, 0, 21)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '002',
            'description' => 'Davao',
            'color' => 'rgb(255, 0, 242)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '003',
            'description' => 'CDO',
            'color' => 'rgb(127, 0, 255)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '004',
            'description' => 'GenSan',
            'color' => 'rgb(21, 0, 255)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '005',
            'description' => 'Mindoro',
            'color' => 'rgb(0, 153, 255)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '006',
            'description' => 'Tuguegarao',
            'color' => 'rgb(0, 255, 25)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Branch::factory()->create([
            'code' => '007',
            'description' => 'Vigan',
            'color' => 'rgb(234, 255, 5)',
            'modified_by' => 1,
            'created_by' => 1,
        ]);
    }
}
