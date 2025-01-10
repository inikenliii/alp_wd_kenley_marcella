<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        // Validate user information fields
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'image_profile' => 'nullable|image|max:1024', // Validate the image if provided
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image_profile')) {
            // Delete old profile image if exists
            if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
                unlink(storage_path('app/public/' . $user->image_profile));
            }

            // Store the new image
            $path = $request->file('image_profile')->store('profile_images', 'public');
            $user->image_profile = $path;
        }

        // Update user information fields
        $user->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request, User $user)
    {
        // Validate the password
        $request->validate([
            'password' => 'required|string',
        ]);

        // Check if the entered password matches the current user's password
        if (!Hash::check($request->password, auth::user()->password)) {
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        // Delete the user's profile image if it exists
        if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
            unlink(storage_path('app/public/' . $user->image_profile));
        }

        // Delete the user account
        $user->delete();

        return redirect('/');
    }

}

