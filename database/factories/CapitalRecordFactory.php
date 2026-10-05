<?php

namespace Database\Factories;

use App\Models\CapitalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CapitalRecord>
 */
class CapitalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shareholder_name' => fake()->name(),
            'share_class' => fake()->randomElement(['Ordinary', 'Preference']),
            'allocated_shares' => fake()->numberBetween(100, 100000),
            'total_investment' => fake()->randomFloat(2, 100000, 50000000),
            'is_public' => fake()->boolean(75),
        ];
    }
}
