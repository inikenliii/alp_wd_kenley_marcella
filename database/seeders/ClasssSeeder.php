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
        classs::factory(3)->create();
    }
}
