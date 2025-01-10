<?php

namespace Database\Factories;

use App\Models\Classs; // Pastikan ini ada
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil kelas acak yang sudah ada di dalam database
        $class = Classs::inRandomOrder()->first();

        return [
            'username' => $this->faker->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date(), // Menambahkan tanggal lahir
            'image_profile' => $this->faker->image(),
            'class_id' => $class ? $class->id : null,  // Menambahkan relasi ke kelas yang sudah ada
            'isAdmin' => false, // Atau sesuaikan dengan logika Anda untuk menentukan apakah user ini admin
        ];
    }
}
