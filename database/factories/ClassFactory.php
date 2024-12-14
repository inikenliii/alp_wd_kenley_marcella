<?php

namespace Database\Factories;

use App\Models\classs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id'=> classs::factory(),
            'class_name' => $this->faker->classname(),
            'description' => $this->faker->text()
        ];
    }
}
