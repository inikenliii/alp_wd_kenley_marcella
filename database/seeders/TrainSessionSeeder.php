<?php

namespace Database\Seeders;

use App\Models\TrainSession;
use App\Models\Classs;
use Illuminate\Database\Seeder;

class TrainSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Loop over all classes
        $classes = Classs::all();

        foreach ($classes as $class) {
            // Get all users in this class (users already have class_id set)
            $users = $class->users;

            // Jika kelas tidak memiliki pengguna, lanjutkan ke kelas berikutnya
            if ($users->isEmpty()) {
                continue; // Skip jika tidak ada pengguna
            }

            // Buat 5 sesi pelatihan untuk setiap kelas
            for ($i = 0; $i < 5; $i++) {
                // Pilih pengguna secara acak dari kelas ini
                $user = $users->random();

                // Buat sesi pelatihan untuk pengguna ini
                TrainSession::factory()->create([
                    'class_id' => $class->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
