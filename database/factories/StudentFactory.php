<?php

namespace Database\Factories;

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
        return [
            'student_id' => fake()->randomNumber(6, false),
            'fname' => $firstName,
            'lname' => fake()->lastName($gender),
            'mname' => fake()->lastName($gender),
            'contact' => "+639".fake()->randomNumber(9,true),
            'email' => fake()->freeEmail(),
            'campus' => fake()->randomElement(['CAL', 'ALB', 'ANG', 'CDO', 'CUO', 'GES', 'LIP', 'BAC', 'BAG']),
            'adviser' => fake()->randomElement(['5', '6', '7', '8', '9', '10', '11', '12', '13', '14']),
            'year_level' => fake()->randomElement(['3RD', '4TH']),
            'address' => fake()->streetAddress() . " " . fake()->cityPrefix(),
            'family_contact_name' => fake()->firstName($gender) . " " . fake()->lastName($gender),
            'family_contact' => fake()->e164PhoneNumber(),
            'date_applied' => Carbon::createFromTimestamp(rand(strtotime("2022-01-01"), strtotime("2022-11-10")))->format('Y-m-d'),
            'gender' => $gender,
            'isactive' => fake()->randomElement(['Active']),
        ];
    }
}
