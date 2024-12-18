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
        
            $User = User::count() > 0 
                ? User::all() 
                : User::factory(100)->create();
    
            Payment::factory()
                ->count(10)
                ->recycle($User)
                ->create();
        
    }
}
