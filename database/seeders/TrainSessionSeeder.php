<?php

namespace Database\Seeders;

use App\Models\TrainSession;
use App\Models\Classs;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TrainSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Loop through each class
        $classes = Classs::all();

        foreach ($classes as $class) {
            // Get users assigned to the current class
            $users = $class->users;

            // Skip if there are no users in this class
            if ($users->isEmpty()) {
                continue;
            }

            // Create 5 training sessions for each user in the class
            foreach ($users as $user) {
                // Starting date for sessions (future date)
                $startDate = Carbon::now()->addDays(1);  // Start from tomorrow

                for ($i = 1; $i <= 5; $i++) {
                    // Calculate the date for the current session (no overlapping)
                    $sessionDate = $startDate->copy()->addWeeks($i);

                    // Set the start time exactly on the hour between 8:00 AM and 6:00 PM
                    $startTime = Carbon::createFromFormat('H:i:s', '08:00:00')->addHours($i); // Example: 8:00 AM, 9:00 AM, etc.

                    // Set end time exactly 2 hours after start time
                    $endTime = $startTime->copy()->addHours(2); // End time is 2 hours later

                    // Create a training session for the user
                    TrainSession::create([
                        'trainsession_date' => $sessionDate->format('Y-m-d'), // Format date (e.g., '2025-01-15')
                        'image' => 'https://via.placeholder.com/150',
                        'start_time' => $startTime->format('H:i:s'),  // Format time (e.g., '08:00:00', '09:00:00')
                        'end_time' => $endTime->format('H:i:s'),      // Format time (e.g., '10:00:00', '11:00:00')
                        'description' => 'Training Session ' . $i . ' for Class ' . $class->class_name,
                        'class_id' => $class->id,
                        'user_id' => $user->id, // Associate the session with the user
                    ]);
                }
            }
        }
    }
}
