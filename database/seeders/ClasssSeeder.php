<?php

namespace Database\Seeders;

use App\Models\classs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classData = [
            ['class_name' => 'KU 12', 'description' => 'Untuk usia 10-12 tahun'],
            ['class_name' => 'KU 14', 'description' => 'Untuk usia 12-14 tahun'],
            ['class_name' => 'KU 16', 'description' => 'Untuk usia 14-16 tahun'],
            ['class_name' => 'KU 18', 'description' => 'Untuk usia 16-18 tahun'],
            ['class_name' => 'Adult', 'description' => 'Untuk usia 19 tahun ke atas'],
        ];

        foreach ($classData as $class) {
            Classs::factory()->create($class);
        }
    }
}
