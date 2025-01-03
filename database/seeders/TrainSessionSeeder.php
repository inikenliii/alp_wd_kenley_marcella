<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\TrainSession;
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

        // Buat train sessions hanya untuk user_id 1-10
        TrainSession::factory()
            ->count(100)
            ->state(function () use ($classes) {
                return [
                    'class_id' => $classes->random()->id, // Relasi ke class
                    'user_id' => rand(1, 10),             // Hanya user_id 1-10
                ];
            })
            ->create();
    }
}
