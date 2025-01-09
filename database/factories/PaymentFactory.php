<?php

namespace Database\Factories;

use App\Models\payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the foreign key constraint (revert the changes made in up())
            $table->dropForeign(['user_id']);
        });
    }
}
