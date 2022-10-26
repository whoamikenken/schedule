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
            'description' => 'Campus',
            'table' => 'campus'
        ]);

        Setup::factory()->create([
            'description' => 'Course',
            'table' => 'courses'
        ]);

        Setup::factory()->create([
            'description' => 'Section',
            'table' => 'sections'
        ]);

        Setup::factory()->create([
            'description' => 'Year Level',
            'table' => 'yearlevel'
        ]);

        Setup::factory()->create([
            'description' => 'Subject',
            'table' => 'subject'
        ]);

        Setup::factory()->create([
            'description' => 'Annoucement',
            'table' => 'announcement'
        ]);
    }
}
