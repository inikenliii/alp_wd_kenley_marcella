<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\TrainSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data existing sebelum seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Attendance::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Pastikan users ada
        $users = User::count() > 0 
            ? User::all() 
            : User::factory(100)->create();

        // Pastikan train sessions ada
        $trainSessions = trainsession::count() > 0 
            ? trainsession::all() 
            : trainsession::factory(100)->create();

        // Buat attendance dengan kombinasi unik
        Attendance::factory()
            ->count(10)
            ->state(function () use ($users, $trainSessions) {
                return [
                    'user_id' => $users->random()->id,
                    'trainsession_id' => $trainSessions->random()->id,
                ];
            })
            ->create();
    }
}