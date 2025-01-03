<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\TrainSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSessionSeeder extends Seeder
{
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

        // Buat 5 sesi pelatihan untuk setiap kelas
        foreach ($classes as $class) {
            foreach (range(1, 5) as $index) {
                TrainSession::factory()->create([
                    'class_id' => $class->id,
                ]);
            }
        }
    }
}
