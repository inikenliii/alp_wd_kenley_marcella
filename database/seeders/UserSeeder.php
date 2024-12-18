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
        {
            // Buat 5 instance Classs jika belum ada
            $classes = Classs::count() > 0 
                ? Classs::all() 
                : Classs::factory(5)->create();
    
            User::factory()
                ->count(100)
                ->recycle($classes)
                ->create();
        }
    }
}
