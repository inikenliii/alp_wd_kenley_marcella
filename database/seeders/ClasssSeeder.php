<?php

namespace Database\Seeders;

use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasssSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Classs::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $classData = [
            ['class_name' => 'KU 12', 'description' => 'Untuk usia 10-12 tahun'],
            ['class_name' => 'KU 14', 'description' => 'Untuk usia 12-14 tahun'],
            ['class_name' => 'KU 16', 'description' => 'Untuk usia 14-16 tahun'],
            ['class_name' => 'KU 18', 'description' => 'Untuk usia 16-18 tahun'],
            ['class_name' => 'Adult', 'description' => 'Untuk usia 19 tahun ke atas'],
        ];

        foreach ($classData as $class) {
            Classs::updateOrCreate(['class_name' => $class['class_name']], $class);
        }
        $this->command->info('Classes count: ' . Classs::count());
    }
}
