<?php

namespace Database\Seeders;

use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasssSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['class_name' => 'KU 12', 'description' => 'Untuk usia 10-12 tahun'],
            ['class_name' => 'KU 14', 'description' => 'Untuk usia 12-14 tahun'],
            ['class_name' => 'KU 16', 'description' => 'Untuk usia 14-16 tahun'],
            ['class_name' => 'KU 18', 'description' => 'Untuk usia 16-18 tahun'],
            ['class_name' => 'Adult', 'description' => 'Untuk usia 19 tahun ke atas'],
        ];

        foreach ($classes as $class) {
            Classs::firstOrCreate(
                ['class_name' => $class['class_name']],
                $class
            );
        }
    }
}