<?php

namespace Database\Seeders;

use App\Models\attendance;
use App\Models\classs;
use App\Models\payment;
use App\Models\trainsession;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        attendance::factory()->count(10)->recycle(User::factory(3)->create())->create();
        User::factory()->count(10)->recycle(classs::factory(3)->create())->create();
        trainsession::factory()->count(10)->recycle(classs::factory(3)->create())->create();
        payment::factory()->count(10)->recycle(User::factory(3)->create())->create();
        attendance::factory()->count(10)->recycle(trainsession::factory(3)->create())->create();
    }
}
