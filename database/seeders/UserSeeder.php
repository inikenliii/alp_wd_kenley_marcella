<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
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
                $birthDate = $attributes['birth_date'];
                $age = now()->year - date('Y', strtotime($birthDate));

                $classId = match (true) {
                    $age >= 10 && $age <= 12 => $classes->where('class_name', 'KU 12')->first()->id,
                    $age >= 12 && $age <= 14 => $classes->where('class_name', 'KU 14')->first()->id,
                    $age >= 14 && $age <= 16 => $classes->where('class_name', 'KU 16')->first()->id,
                    $age >= 16 && $age <= 18 => $classes->where('class_name', 'KU 18')->first()->id,
                    $age > 18 => $classes->where('class_name', 'Adult')->first()->id,
                    default => $classes->random()->id,
                };

                return ['class_id' => $classId];
            })
            ->create();
            User::factory()->create([
                'username' => 'admin123',
                'password' => bcrypt('password'),
                'name' => 'admin',
                'phone_number' => '081234567890',
                'address' => 'lalalalalla',
                'isAdmin' => true,
            ]);


    }
}
