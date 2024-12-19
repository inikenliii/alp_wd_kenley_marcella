<?php

namespace Database\Factories;

use App\Models\classs;
use App\Models\trainsession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainSession>
 */
class TrainSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trainsession_date' => $this->faker->date(),
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.thehoopsgeek.com%2Fbasketball-training-equipment%2F&psig=AOvVaw0dsJOzaiAxN4xx2PtnLu7L&ust=1734590911506000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCJCawu7csIoDFQAAAAAdAAAAABAJ',
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'description' => $this->faker->text(),
            'class_id' => classs::factory(),
            'user_id' => User::factory(),  
        ];
    }
}
