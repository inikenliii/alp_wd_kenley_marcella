<?php

namespace Database\Seeders;

use App\Models\classs;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // User::factory()->count(10)->recycle(classs::factory(3)->create())->create();
    }
}
