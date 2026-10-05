<?php

namespace Database\Factories;

use App\Models\InventoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => fake()->unique()->words(3, true),
            'sku' => 'ITM-'.fake()->unique()->bothify('????-####'),
            'location' => fake()->randomElement(['Akure', 'Ifo']),
            'quantity_in_stock' => fake()->numberBetween(0, 100),
            'unit_price' => fake()->randomFloat(2, 100, 500000),
            'status' => 'in_stock',
        ];
    }
}
