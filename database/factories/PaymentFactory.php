<?php

namespace Database\Factories;

use App\Models\payment;
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
        return [            'payment_date' => $this->faker->date(),
            'amount' => $this->faker->integer(),
            'month_paid' => $this->faker->monthName(),
            'payment_status' => $this->faker->enum(['paid'],['pending'])
        ];
    }
}
