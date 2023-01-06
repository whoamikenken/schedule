<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->firstName();
        $gender = fake()->randomElement(['Male', 'Female']);
        $studentNo = fake()->randomNumber(6, false);
        $mname = fake()->lastName($gender);
        $lname = fake()->lastName($gender);
        $email = fake()->freeEmail();
        $contact = "+639" . fake()->randomNumber(9, true);
        
        User::factory()->create([
            'username' => $studentNo,
            'name' => $firstName . " " . $lname,
            'fname' => $firstName,
            'lname' => $lname,
            'email' => $email,
            'user_type' => 'Student',
            'status' => 'verified',
            'email_verified_at' => now(),
            'password' => bcrypt('a'), // password
            'read' => "17,803,804,18",
            'add' => "17,18",
            'delete' => "17,18",
            'edit' => "17,804,18",
            'remember_token' => Str::random(10)
        ]);

        return [
            'student_id' => $studentNo,
            'fname' => $firstName,
            'lname' => $lname,
            'mname' => $mname,
            'contact' => $contact,
            'email' => $email,
            'campus' => fake()->randomElement(['CAL', 'ALB', 'ANG', 'CDO', 'CUO', 'GES', 'LIP', 'BAC', 'BAG']),
            'adviser' => fake()->randomElement(['5', '6', '7', '8', '9', '10', '11', '12', '13', '14']),
            'course' => fake()->randomElement(['ACCT', 'CITE', 'CBMC', 'CASC', 'BUSS', 'ACOM', 'COSC', 'CTHC', 'GEDC', 'INTE']),
            'year_level' => fake()->randomElement(['1Y1', '1Y2', '2Y1', '2Y2', '3Y1','3Y2', '3Y2', '3Y2']),
            'section' => fake()->randomElement(['A', 'B', 'C']),
            'address' => fake()->streetAddress() . " " . fake()->cityPrefix(),
            'family_contact_name' => fake()->firstName($gender) . " " . fake()->lastName($gender),
            'family_contact' => fake()->e164PhoneNumber(),
            'date_applied' => Carbon::createFromTimestamp(rand(strtotime("2022-01-01"), strtotime("2022-11-10")))->format('Y-m-d'),
            'gender' => $gender,
            'isactive' => fake()->randomElement(['Active']),
        ];
    }
}
