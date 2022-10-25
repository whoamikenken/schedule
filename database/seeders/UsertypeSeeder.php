<?php

namespace Database\Seeders;

use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usertype::factory()->create([
            'code' => 'Admin',
            'description' => 'Administrator has all the permission on modules',
            'modified_by' => 1,
            'read' => "5,6,12,13,14,7,8,9,10,11,801,802,803,804,15,999",
            'add' => "6,12,13,7,8,9,10,11",
            'delete' => "6,12,13,7,8,9,10,11",
            'edit' => "6,12,13,7,8,9,10,11,801,802,803,804,15,999",
            'created_by' => 1,
        ]);

        Usertype::factory()->create([
            'code' => 'Sales',
            'description' => 'Sales can only view and create applicants',
            'modified_by' => 1,
            'created_by' => 1,
        ]);
    }
}
