<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'customer_id' => null,
            'status' => 'uncomplete',
            'weight' => 500,
            'rate' => 220,
            'total' => 110000, 'fy' =>
            '2079/80',
        ];
    }
}
