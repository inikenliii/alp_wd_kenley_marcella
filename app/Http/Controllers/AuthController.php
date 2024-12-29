<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        // Check if the user is already logged in
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('home', ['id' => Auth::id()]);
        }
        else {
            return view('auth.register');
        }
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|confirmed|min:8',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'image_profile' => 0, // Optional if you want to allow image upload
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/login');
    }

    // Show login form
    public function showLoginForm()
    {
        // Check if the user is already logged in
        if (Auth::check()) {
            // Redirect to the home page if the user is already logged in
            return redirect()->route('home', ['id' => Auth::id()]);
        }
        else {
            return view('auth.login');
        }
    }

    public function login(Request $request) {

        // Get the username and password from the request
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Store the authenticated user's ID in the session
            session(['user_id' => Auth::id()]);

            // Redirect to the intended route or home page
            return redirect()->route('home', ['id' => Auth::id()]);
        }

        // If authentication fails, return an error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
