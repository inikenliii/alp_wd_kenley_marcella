<?php

namespace Database\Seeders;

use App\Models\classs;
use App\Models\trainsession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // trainsession::factory(3)->create();
        trainsession::factory()->count(100)->recycle(classs::factory(3)->create())->create();
    }
}
