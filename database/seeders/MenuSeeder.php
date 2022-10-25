<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Menus

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'title' => 'Main',
            'link' => '',
            'icon' => '',
            'description' => ""
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'title' => 'Human Management',
            'link' => '',
            'icon' => '',
            'description' => ""
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'title' => 'System Setup',
            'link' => '',
            'icon' => '',
            'description' => ""
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'title' => 'System Configuration',
            'link' => '',
            'icon' => '',
            'description' => ""
        ]);
    
        Menu::factory()->create([
            'root' => '1',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            }, 
            'order' => function () {
                $maxOrder = Menu::where('root','=','1')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Dashboard',
            'link' => 'home',
            'icon' => 'motherboard',
            'description' => "Visual display of all of your data"
        ]);

        Menu::factory()->create([
            'root' => '2',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','2')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'User Management',
            'link' => 'user/user',
            'icon' => 'person-badge',
            'description' => "User management add and edit permission"
        ]);

        Menu::factory()->create([
            'root' => '3',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','3')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Branch',
            'link' => 'setup/branch',
            'icon' => 'inboxes',
            'description' => "Creating new branches"
        ]);

        Menu::factory()->create([
            'root' => '3',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','3')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Location',
            'link' => 'setup/location',
            'icon' => 'geo-alt',
            'description' => "Creating new locations"
        ]);

        Menu::factory()->create([
            'root' => '3',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','3')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Medical Clinic',
            'link' => 'setup/medical',
            'icon' => 'hospital',
            'description' => "Creating new medical clinic"
        ]);

        Menu::factory()->create([
            'root' => '3',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','3')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Principals',
            'link' => 'setup/principal',
            'icon' => 'building',
            'description' => "Creating new principals"
        ]);

        Menu::factory()->create([
            'root' => '3',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','3')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Jobsites',
            'link' => 'setup/jobsite',
            'icon' => 'airplane-engines',
            'description' => "Creating new jobsites"
        ]);

        Menu::factory()->create([
            'root' => '2',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','2')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'User type',
            'icon' => 'people',
            'link' => 'user/usertype',
            'description' => "Creating new usertype"
        ]);

        Menu::factory()->create([
            'root' => '2',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','2')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Applicant List',
            'link' => 'user/applicant',
            'icon' => 'person-rolodex',
            'description' => "Creating new applicant and modification"
        ]);

        Menu::factory()->create([
            'root' => '2',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '2')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Reports',
            'link' => 'report/reports',
            'icon' => 'printer',
            'description' => "List of reports"
        ]);

        Menu::factory()->create([
            'root' => '4',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '4')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Table Picker',
            'link' => 'config/tablecolumn',
            'icon' => 'wrench-adjustable-circle',
            'description' => "Modification of setup column."
        ]);

    }
}
