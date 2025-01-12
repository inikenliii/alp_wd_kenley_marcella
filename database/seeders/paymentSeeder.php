<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users or create them if none exist
        $users = User::count() > 0 
            ? User::all() 
            : User::factory(100)->create();  // You can omit the factory if you don't want to create users here
        
        // Create payments for each user for 3 months (as an example)
        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) { // Example: creating payments for 3 months
                // Create a payment record for the user
                $payment = Payment::create([
                    'user_id' => $user->id,
                    'payment_date' => now()->addMonths($i), // Set payment date for the next months
                    'amount' => 200000, // Fixed amount of 200,000 IDR
                    'month_paid' => now()->addMonths($i)->monthName,
                    'payment_status' => 'pending', // Default status is 'pending'
                ]);

                // Optional: Update some payments to 'paid' (this could be based on your logic)
                if ($i === 2) {  // Example: Mark the second month as 'paid'
                    $payment->update(['payment_status' => 'paid']);
                }
            }
        }
    }
}
