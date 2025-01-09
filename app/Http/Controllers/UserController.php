<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the profile of a specific user.
     */
    public function show($id)
    {
        // Check if the authenticated user id matches the route id
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        // Retrieve the user and their related models (classs, attendance, payment, trainsession)
        $user = User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id);

        // Return the profile view with the necessary data
        return view('profile', [
            'pagetitle' => $user->username . ' Detail', // Set the page title dynamically
            'user' => $user, // Pass the user data to the view
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'image_profile' => 'required|image|max:1024', // Validate that the file is an image
        ]);

        // Handle image upload
        if ($request->hasFile('image_profile')) {
            // Delete old profile image if exists
            if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
                unlink(storage_path('app/public/' . $user->image_profile));
            }

            // Store the new image
            $path = $request->file('image_profile')->store('profile_images', 'public');
            $user->image_profile = $path;
            $user->save();
        }

        return redirect()->route('profile', $user->id)->with('success', 'Profile image updated successfully');
    }

}

