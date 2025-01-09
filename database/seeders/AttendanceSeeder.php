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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $users = User::all();
        $trainSessions = TrainSession::all();

        foreach ($users as $user) {
            // Ambil sesi pelatihan yang sesuai dengan kelas user
            $sessionsForClass = $trainSessions->where('class_id', $user->class_id);

            foreach ($sessionsForClass as $session) {
                // Buat attendance untuk user dan sesi pelatihan
                Attendance::firstOrCreate([
                    'user_id' => $user->id,
                    'trainsession_id' => $session->id,
                ], [
                    'attendance_date' => now()->toDateString(), // Berikan nilai untuk kolom attendance_date
                ]);
            }
        }
    }
}
