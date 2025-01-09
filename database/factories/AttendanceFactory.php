<?php

namespace Database\Factories;

use App\Models\attendance;
use App\Models\trainsession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'trainsession_id' => trainsession::factory(),
            'attendance_status' => $this->faker->randomElement(['present', 'absent']),
            'attendance_date' => $this->faker->date(), 
        ];
    }
}
