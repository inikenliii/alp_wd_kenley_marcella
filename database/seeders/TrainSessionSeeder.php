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
        $classes = Classs::count() > 0 
        ? Classs::all() 
        : Classs::factory(5)->create();

    TrainSession::factory()
        ->count(100)
        ->recycle($classes)
        ->create();
    }
}
