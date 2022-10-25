<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'code' => strtoupper(Str::random(3)),
            // 'description' => fake()->company(),
            // 'address' => fake()->address(),
            // 'contact' => fake()->phoneNumber(),
            // 'location' => 'MNL',
            // 'jobsite' => 'HK',
            // 'modified_by' => 1,
            // 'created_by' => 1,
        ];
    }
}
