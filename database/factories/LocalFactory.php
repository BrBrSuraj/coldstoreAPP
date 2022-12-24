<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Local>
 */
class LocalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'remark'=>fake()->text(50),
            'weight'=>fake()->numberBetween(500,10000),
            'rate'=>fake()->numberBetween(200,250),
            'total'=>fake()->numberBetween(5000,10000),
            'user_id'=>null,
            'fy'=> '2079/80',
        ];
    }
}
