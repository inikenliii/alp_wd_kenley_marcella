<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the profile of a specific user.
     */
    public function show($id)
    {
        // Retrieve the user and their related models (classs, attendance, payment, trainsession)
        $user = User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id);

        // Return the profile view with the necessary data
        return view('profile', [
            'pagetitle' => $user->username . ' Detail', // Set the page title dynamically
            'user' => $user, // Pass the user data to the view
        ]);
    }
}

