<?php

namespace Database\Seeders;

use App\Models\payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        payment::factory(10)->create();
        // payment::factory()->count(10)->recycle(User::factory(3)->create())->create();
    }
}
