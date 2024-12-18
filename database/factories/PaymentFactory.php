<?php

namespace Database\Factories;

use App\Models\payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'payment_date' => $this->faker->date(),
            'amount' => 200000,
            'month_paid' => $this->faker->monthName(),
            'payment_status' => $this->faker->randomElement(['paid'],['pending'])
        ];
    }
}
