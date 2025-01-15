<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create default classes if not exists
        $classes = Classs::count() > 0 ? Classs::all() : $this->createDefaultClasses();

        // Helper function to assign class by age
        $getClassByAge = function ($birthDate) use ($classes) {
            $age = now()->year - date('Y', strtotime($birthDate));

            return match (true) {
                $age >= 10 && $age <= 12 => $classes->where('class_name', 'KU 12')->first()?->id,
                $age >= 12 && $age <= 14 => $classes->where('class_name', 'KU 14')->first()?->id,
                $age >= 14 && $age <= 16 => $classes->where('class_name', 'KU 16')->first()?->id,
                $age >= 16 && $age <= 18 => $classes->where('class_name', 'KU 18')->first()?->id,
                $age > 18 => $classes->where('class_name', 'Adult')->first()?->id,
                default => null,
            };
        };

        // Create specific users
        User::create([
            'username' => 'kenley123',
            'password' => Hash::make('password'),
            'name' => 'kenley',
            'phone_number' => '081234567891',
            'address' => 'lululululu',
            'isAdmin' => false,
            'birth_date' => '2005-01-20',
            'class_id' => $getClassByAge('2005-01-20'),
        ]);

        // Create users aged 11-18
        $users = [
            ['username' => 'user11', 'birth_date' => '2014-01-01'],
            ['username' => 'user12', 'birth_date' => '2013-01-01'],
            ['username' => 'user13', 'birth_date' => '2012-01-01'],
            ['username' => 'user14', 'birth_date' => '2011-01-01'],
            ['username' => 'user15', 'birth_date' => '2010-01-01'],
            ['username' => 'user16', 'birth_date' => '2009-01-01'],
            ['username' => 'user17', 'birth_date' => '2008-01-01'],
            ['username' => 'user18', 'birth_date' => '2007-01-01'],
        ];

        foreach ($users as $user) {
            User::create([
                'username' => $user['username'],
                'password' => Hash::make('password'),
                'name' => $user['username'],
                'phone_number' => '0812345678' . random_int(10, 99),
                'address' => 'Default Address',
                'isAdmin' => false,
                'birth_date' => $user['birth_date'],
                'class_id' => $getClassByAge($user['birth_date']),
            ]);
        }

        // Create admin
        User::create([
            'username' => 'admin123',
            'password' => Hash::make('password'),
            'name' => 'admin',
            'phone_number' => '081234567890',
            'address' => 'lalalalalla',
            'isAdmin' => true,
            'birth_date' => '2000-01-01',
            'class_id' => $getClassByAge('2000-01-01'),
        ]);
    }

    /**
     * Create default classes if not exists.
     */
    private function createDefaultClasses()
    {
        $defaultClasses = [
            ['class_name' => 'KU 12'],
            ['class_name' => 'KU 14'],
            ['class_name' => 'KU 16'],
            ['class_name' => 'KU 18'],
            ['class_name' => 'Adult'],
        ];

        foreach ($defaultClasses as $class) {
            Classs::create($class);
        }

        return Classs::all();
    }
}
