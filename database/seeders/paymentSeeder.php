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
        {
            $user = user::count() > 0 
                ? user::all() 
                : user::factory(100)->create();
    
            Payment::factory()
                ->count(1)
                ->recycle($user)
                ->create();
        }
    }
}
