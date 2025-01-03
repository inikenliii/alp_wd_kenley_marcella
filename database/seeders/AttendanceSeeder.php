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

        // Ambil semua user dan sesi pelatihan
        $users = User::all();
        $trainSessions = TrainSession::all();

        // Untuk setiap user, tambahkan kehadiran di semua sesi pelatihan di kelasnya
        foreach ($users as $user) {
            $userTrainSessions = $trainSessions->where('class_id', $user->class_id);

            foreach ($userTrainSessions as $session) {
                Attendance::factory()->create([
                    'user_id' => $user->id,
                    'trainsession_id' => $session->id,
                ]);
            }
        }
    }
}
