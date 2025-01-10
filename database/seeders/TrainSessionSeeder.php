<?php

namespace Database\Seeders;

use App\Models\TrainSession;
use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSessionSeeder extends Seeder
{
    public function run(): void
    {
        $classes = Classs::all();
    
        // Buat train sessions
        TrainSession::factory()
            ->count(5)
            ->state(function () use ($classes) {
                return [
                    'class_id' => $classes->random()->id, // Ambil ID secara acak dari data yang ada
                ];
            })
            ->create();
    }
    

}
