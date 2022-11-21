<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Section::factory()->create([
            'code' => 'A',
            'description' => 'A'
        ]);

        Section::factory()->create([
            'code' => 'B',
            'description' => 'B'
        ]);

        Section::factory()->create([
            'code' => 'C',
            'description' => 'C'
        ]);
    }
}
