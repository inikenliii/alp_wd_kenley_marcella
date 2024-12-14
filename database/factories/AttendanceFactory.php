<?php

namespace Database\Factories;

use App\Models\attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'attendance_id'=> attendance::factory(),
            'attendance_status' => $this->faker->randomElement(['present', 'absent']),
            'attendance_date' => $this->faker->date()
        ];
    }
}
