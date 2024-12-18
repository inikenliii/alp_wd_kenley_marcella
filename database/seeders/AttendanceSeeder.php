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
        
            $User = User::count() > 0 
                ? User::all() 
                : User::factory(100)->create();
    
            attendance::factory()
                ->count(1)
                ->recycle($User)
                ->create();
        
        
            $trainsession = trainsession::count() > 0 
                ? trainsession::all() 
                : trainsession::factory(100)->create();
    
            attendance::factory()
                ->count(5)
                ->recycle($trainsession)
                ->create();
        
    }
}
