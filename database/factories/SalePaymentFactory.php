<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalePayment>
 */
class SalePaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'sale_id' => null,
            'amount' => fake()->numberBetween(20000, 50000),
            'user_id' => null,
            'fy' =>
            '2079/80',
        ];
    }
}
