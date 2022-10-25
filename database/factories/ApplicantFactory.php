<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->firstName();
        $gender = fake()->randomElement(['male', 'female']);
        $medFirstCost = fake()->randomElement(['500', '1000', '1500']);
        $medSecondCost = fake()->randomElement(['500', '1000', '1500']);
        $medThirdCost = fake()->randomElement(['500', '1000', '1500']);
        $medFourthCost = fake()->randomElement(['500', '1000', '1500']);
        $nc2Cost = fake()->randomElement(['500', '1000', '1500']);
        $totalCost = $medFirstCost + $medSecondCost + $medThirdCost + $medFourthCost + $nc2Cost;
        return [
            'applicant_id' => fake()->randomNumber(6, false),
            'fname' => $firstName,
            'er_ref' => fake()->randomNumber(6, false),
            'maid_ref' => fake()->randomNumber(6, false),
            'lname' => fake()->lastName($gender),
            'mname' => fake()->lastName($gender),
            'contact' => fake()->e164PhoneNumber(),
            'branch' => fake()->randomElement(['001', '002', '005','004','003','006', '007']),
            'sales_manager' => fake()->randomElement(['5', '6', '7','8', '9', '10','11','12','13', '14']),
            'jobsite' => fake()->randomElement(['MY', 'HK']),
            'address' => fake()->streetAddress()." ". fake()->cityPrefix(),
            'family_contact_name' => fake()->firstName($gender)." ". fake()->lastName($gender),
            'family_contact' => fake()->e164PhoneNumber(),
            'is_ex_abroad' => fake()->randomElement(['Yes', 'No']),
            'is_first' => fake()->randomElement(['Yes', 'No']),
            'is_walkin' => fake()->randomElement(['Yes', 'No']),
            'abroad_experience' => fake()->randomNumber(1, false),
            'date_applied' => fake()->date(),
            'passport_no' => fake()->randomNumber(9, true),
            'passport_issued' => fake()->date(),
            'passport_validity' => Carbon::createFromTimestamp(rand(strtotime("2020-12-01"), strtotime("2025-08-01")))->format('Y-m-d'),
            'passport_place_issued' => fake()->randomElement(['MY', 'HK', 'PH']),
            'vac_first_dose_date' => fake()->date(),
            'vac_first_brand' => fake()->randomElement(['Pfizer', 'AstraZeneca','Sputnik', 'Moderna']),
            'vac_first_country' => fake()->randomElement(['MY', 'HK', 'PH']),
            'vac_second_dose_date' => fake()->date(),
            'vac_second_brand' => fake()->randomElement(['Pfizer', 'AstraZeneca', 'Sputnik', 'Moderna']),
            'vac_second_country' => fake()->randomElement(['MY', 'HK', 'PH']),
            'vac_booster_dose_date' => fake()->date(),
            'vac_booster_brand' => fake()->randomElement(['Pfizer', 'AstraZeneca', 'Sputnik', 'Moderna']),
            'vac_booster_country' => fake()->randomElement(['MY', 'HK', 'PH']),
            'bio_trans_date' => fake()->date(),
            'bio_lunch_date' => fake()->date(),
            'bio_status' => fake()->randomElement(['Pending', 'Approved', 'Disapproved']),
            'bio_availability' => fake()->randomElement(['Sold','Available','Signed Up','Pending','Backed out', 'Resell/Push']),
            'jo_received' => fake()->date(),
            'jo_confirmed' => fake()->date(),
            'jo_er_iscancel' => fake()->randomElement(['Yes', 'No']),
            'jo_maid_iscancel' => fake()->randomElement(['Yes', 'No']),
            'med_first_date' => fake()->date(),
            'med_first_result' => fake()->randomElement(['Fit to work','Unfit', 'Pending']),
            'med_first_clinic' => fake()->randomElement(['Q3Y', 'ZV0', 'DDT', 'AG4', 'IKB', 'CH4']),
            'med_first_cost' => $medFirstCost,
            'med_second_date' => fake()->date(),
            'med_second_result' => fake()->randomElement(['Fit to work', 'Unfit', 'Pending']),
            'med_second_clinic' => fake()->randomElement(['Q3Y', 'ZV0', 'DDT', 'AG4', 'IKB', 'CH4']),
            'med_second_cost' => $medSecondCost,
            'med_third_date' => fake()->date(),
            'med_third_result' => fake()->randomElement(['Fit to work', 'Unfit', 'Pending']),
            'med_third_clinic' => fake()->randomElement(['Q3Y', 'ZV0', 'DDT', 'AG4', 'IKB', 'CH4']),
            'med_third_cost' => $medThirdCost,
            'med_fourth_date' => fake()->date(),
            'med_fourth_result' => fake()->randomElement(['Fit to work', 'Unfit', 'Pending']),
            'med_fourth_clinic' => fake()->randomElement(['Q3Y', 'ZV0', 'DDT', 'AG4', 'IKB', 'CH4']),
            'med_fourth_cost' => $medFourthCost,
            'cert_nc2_cost' => $nc2Cost,
            'oec_flight_departure' => Carbon::createFromTimestamp(rand(strtotime("2022-01-01"), strtotime("2022-10-31")))->format('Y-m-d'),
            'date_applied' => Carbon::createFromTimestamp(rand(strtotime("2022-01-01"), strtotime("2022-10-31")))->format('Y-m-d'),
            'jo_received' => Carbon::createFromTimestamp(rand(strtotime("2022-01-01"), strtotime("2022-10-31")))->format('Y-m-d'),
            'passport_no' => fake()->randomNumber(9, true),
            'visa_date_expired' => Carbon::createFromTimestamp(rand(strtotime("2020-12-01"), strtotime("2025-08-01")))->format('Y-m-d'),
            'user_video' => 'user_video/rboKUqmdLcZFS64SRvqiPlZQ1xaVv3KCXAbdFIuU.mp4',
            'user_profile' => 'user_profile/Edi3iPU9axNHMnIcC9yK2MK75DKH5xy0GsLIfl1g.png',
            'user_profile_face' => 'user_profile_face/QVIXo2IeNZfBfjm7ZsALxSZMNTd3kD66UfLWUARx.png',
            'total_cost' => $totalCost,
            'gender' => $gender,
            'isactive' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
