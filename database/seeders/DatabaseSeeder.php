<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Branch;
use App\Models\Jobsite;
use App\Models\Medical;
use App\Models\Location;
use App\Models\Applicant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\LocationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => "whoamiken",
            'name' => "Kennedy Hipolito",
            'fname' => "Kennedy",
            'lname' => "Hipolito",
            'email' => "whoamikenken@gmail.com",
            'user_type' => 'Admin',
            'status' => 'verified',
            'email_verified_at' => now(),
            'password' => bcrypt('a'), // password
            'read' => "5,6,12,13,14,7,8,9,10,11,801,802,803,804,15,999",
            'add' => "6,12,13,7,8,9,10,11",
            'delete' => "6,12,13,7,8,9,10,11",
            'edit' => "6,12,7,8,9,10,11,801,802,803,804,15",
            'remember_token' => Str::random(10)
        ]);

        User::factory()->create([
            'username' => "ethan",
            'name' => "Ethan Liew",
            'fname' => "Ethan",
            'lname' => "Liew",
            'email' => "ethanliew.now@gmail.com",
            'user_type' => 'Admin',
            'status' => 'verified',
            'email_verified_at' => now(),
            'password' => bcrypt('a'), // password
            'read' => "5,6,12,13,14,7,8,9,10,11,801,802,803,804,15,999",
            'add' => "6,12,13,7,8,9,10,11",
            'delete' => "6,12,13,7,8,9,10,11",
            'edit' => "6,12,7,8,9,10,11,801,802,803,804,15",
            'remember_token' => Str::random(10)
        ]);

        User::factory()->create([
            'username' => "juliet",
            'name' => "Juliet Lingon",
            'fname' => "Juliet",
            'lname' => "Lingon",
            'email' => "julietlingon@icloud.com",
            'user_type' => 'Admin',
            'status' => 'verified',
            'email_verified_at' => now(),
            'password' => bcrypt('a'), // password
            'read' => "5,6,12,13,14,7,8,9,10,11,801,802,803,804,15,999",
            'add' => "6,12,13,7,8,9,10,11",
            'delete' => "6,12,13,7,8,9,10,11",
            'edit' => "6,12,7,8,9,10,11,801,802,803,804,15",
            'remember_token' => Str::random(10)
        ]);

        User::factory()->create([
            'username' => "kevin",
            'name' => "Kevin Wong",
            'fname' => "Kevin",
            'lname' => "Wong",
            'email' => "kevinktwong@gmail.com ",
            'user_type' => 'Admin',
            'status' => 'verified',
            'email_verified_at' => now(),
            'password' => bcrypt('a'), // password
            'read' => "5,6,12,13,14,7,8,9,10,11,801,802,803,804,15,999",
            'add' => "6,12,13,7,8,9,10,11",
            'delete' => "6,12,13,7,8,9,10,11",
            'edit' => "6,12,7,8,9,10,11,801,802,803,804,15",
            'remember_token' => Str::random(10)
        ]);

        User::factory(10)->create();
        // Applicant::factory(1000)->create();
        Medical::factory(10)->create();
        
        $this->call([
            BranchSeeder::class,
            LocationSeeder::class,
            JobsiteSeeder::class,
            PrincipalSeeder::class,
            MenuSeeder::class,
            TablecolumnSeeder::class,
            SetupSeeder::class,
            UsertypeSeeder::class
        ]);
    }
}
