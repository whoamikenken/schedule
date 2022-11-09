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
            'order' => function () {
                $maxOrder = Menu::where('root','=','0')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Dashboard',
            'link' => 'home',
            'icon' => 'motherboard',
            'description' => "Visual display of all of your data"
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '0')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Student List',
            'link' => 'student/student',
            'icon' => 'person-lines-fill',
            'description' => "List of student"
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','0')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'User Management',
            'link' => 'user/user',
            'icon' => 'person-badge',
            'description' => "User management add and edit permission"
        ]);

        Menu::factory()->create([
            'root' => '0',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '0')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Applicant List',
            'link' => 'user/user',
            'icon' => 'person-rolodex',
            'description' => "List of applicants"
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
            'root' => '5',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','5')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Campus',
            'link' => 'setup/campus',
            'icon' => 'hospital',
            'description' => "Creating new campuses"
        ]);

        Menu::factory()->create([
            'root' => '5',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '5')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Course',
            'link' => 'setup/course',
            'icon' => 'journal-bookmark',
            'description' => "Creating new courses"
        ]);

        Menu::factory()->create([
            'root' => '5',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '5')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Section',
            'link' => 'setup/section',
            'icon' => 'people',
            'description' => "Creating new section"
        ]);

        Menu::factory()->create([
            'root' => '5',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '5')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Year Level',
            'link' => 'setup/yearlevel',
            'icon' => 'calendar-check',
            'description' => "Creating new Year Level"
        ]);

        Menu::factory()->create([
            'root' => '5',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '5')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Subject',
            'link' => 'setup/subject',
            'icon' => 'inboxes',
            'description' => "Creating new subject"
        ]);

        Menu::factory()->create([
            'root' => '6',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root','=','6')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'User type',
            'icon' => 'people',
            'link' => 'user/usertype',
            'description' => "Creating new usertype"
        ]);


        Menu::factory()->create([
            'root' => '6',
            'menu_id' => function () {
                $max = Menu::count('id'); // returns 0 if no records exist.
                return $max + 1;
            },
            'order' => function () {
                $maxOrder = Menu::where('root', '=', '6')->count('order'); // returns 0 if no records exist.
                return $maxOrder + 1;
            },
            'title' => 'Table Picker',
            'link' => 'config/tablecolumn',
            'icon' => 'wrench-adjustable-circle',
            'description' => "Modification of setup column."
        ]);

    }
}
