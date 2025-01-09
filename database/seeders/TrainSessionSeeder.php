<?php

namespace Database\Seeders;

use App\Models\TrainSession;
use App\Models\User;
use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk menghindari error saat truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TrainSession::truncate(); // Bersihkan tabel train_sessions
        DB::table('train_session_user')->truncate(); // Bersihkan pivot table
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Log jumlah awal kelas dan pengguna
        $this->command->info('Classes count before seeding: ' . Classs::count());
        $this->command->info('Users count before seeding: ' . User::count());

        // Ambil semua kelas dari tabel yang sudah ada
        $classes = Classs::all();

        // Pastikan data kelas ada
        if ($classes->count() === 0) {
            $this->command->info('No classes found. Please ensure ClasssSeeder has been run.');
            return;
        }

        // Loop untuk setiap kelas
        foreach ($classes as $class) {
            // Buat 5 sesi pelatihan untuk setiap kelas
            $trainSessions = collect();

            foreach (range(1, 5) as $index) {
                $trainSessions->push(
                    TrainSession::factory()->create([
                        'class_id' => $class->id, // Gunakan class_id dari data yang sudah ada
                    ])
                );
            }

            // Ambil pengguna yang terkait dengan kelas ini
            $usersInClass = User::where('class_id', $class->id)->get();

            // Pastikan ada pengguna di kelas ini
            if ($usersInClass->isEmpty()) {
                $this->command->info('No users found for class_id: ' . $class->id);
                continue;
            }

            // Hubungkan setiap pengguna dengan sesi pelatihan
            foreach ($usersInClass as $user) {
                $user->trainSessions()->syncWithoutDetaching($trainSessions->pluck('id')->toArray());
            }
        }

        // Log jumlah akhir
        $this->command->info('Classes count after seeding: ' . Classs::count());
        $this->command->info('Users count after seeding: ' . User::count());
        $this->command->info('Train Sessions count: ' . TrainSession::count());
    }
}
