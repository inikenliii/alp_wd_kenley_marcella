<?php

namespace Database\Factories;

use App\Models\classs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\classs>
 */
class ClasssFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_name' => $this->faker->name(),
            'description' => $this->faker->name()
        ];
    }
}
