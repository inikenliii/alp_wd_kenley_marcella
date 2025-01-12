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
        $users = User::all();

        // Pastikan train sessions ada
        $trainSessions = TrainSession::all();

        // Loop each user and assign attendance to each of their sessions
        foreach ($users as $user) {
            // Get the user's train sessions
            $userTrainSessions = $trainSessions->where('user_id', $user->id);

            // If the user has training sessions, create attendance for each
            foreach ($userTrainSessions as $trainSession) {
                $status = 'absent';
                // Randomly set status to 'present' or 'absent'

                Attendance::create([
                    'user_id' => $user->id,
                    'trainsession_id' => $trainSession->id,
                    'attendance_status' => $status,
                    'attendance_date' => $trainSession->trainsession_date, // Attendance date matches session date
                ]);
            }
        }
    }
}
