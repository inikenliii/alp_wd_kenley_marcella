<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan classes tersedia
        $classes = Classs::count() > 0 
            ? Classs::all() 
            : Classs::factory(5)->create(); // Buat kelas jika belum ada

        // Buat 10 pengguna dengan logika penempatan ke kelas
        User::factory()
            ->count(10)
            ->state(function (array $attributes) use ($classes) {
                // Tentukan class_id berdasarkan rentang umur
                $birthDate = $attributes['birth_date']; // Tanggal lahir dari factory
                $age = now()->year - date('Y', strtotime($birthDate)); // Hitung umur

                // Tentukan kelas berdasarkan umur
                $classId = match (true) {
                    $age >= 10 && $age <= 12 => $classes->where('class_name', 'KU 12')->first()->id ?? $classes->random()->id,
                    $age >= 12 && $age <= 14 => $classes->where('class_name', 'KU 14')->first()->id ?? $classes->random()->id,
                    $age >= 14 && $age <= 16 => $classes->where('class_name', 'KU 16')->first()->id ?? $classes->random()->id,
                    $age >= 16 && $age <= 18 => $classes->where('class_name', 'KU 18')->first()->id ?? $classes->random()->id,
                    $age > 18 => $classes->where('class_name', 'Adult')->first()->id ?? $classes->random()->id,
                    default => $classes->random()->id,
                };

                return [
                    'class_id' => $classId, // Tetapkan class_id berdasarkan logika
                ];
            })
            ->create();
    }
}
