<?php

namespace Database\Seeders;

use App\Models\attendance;
use App\Models\trainsession;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        attendance::factory(10)->create();
        // attendance::factory()->count(10)->recycle(User::factory(3)->create())->create();
        // attendance::factory()->count(10)->recycle(trainsession::factory(3)->create())->create();
    }
}
