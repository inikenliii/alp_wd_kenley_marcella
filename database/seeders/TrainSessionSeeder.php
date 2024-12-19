<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\TrainSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data existing sebelum seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TrainSession::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Pastikan classes ada
        $classes = Classs::count() > 0 
            ? Classs::all() 
            : Classs::factory(5)->create();

        // Pastikan users ada
        $users = User::count() > 0 
            ? User::all() 
            : User::factory(10)->create();

        // Buat train sessions dengan kelas dan user yang tersedia
        TrainSession::factory()
            ->count(100)
            ->state(function () use ($classes, $users) {
                return [
                    'class_id' => $classes->random()->id, // Relasi ke class
                    'user_id' => $users->random()->id,    // Relasi ke user
                ];
            })
            ->create();
    }
}
