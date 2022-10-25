<?php

namespace Database\Seeders;

use App\Models\Jobsite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Job Site
        Jobsite::factory()->create([
            'code' => 'HK',
            'description' => 'Hong Kong',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

        Jobsite::factory()->create([
            'code' => 'MY',
            'description' => 'Malaysia',
            'modified_by' => 1,
            'created_by' => 1,
        ]);

    }
}
