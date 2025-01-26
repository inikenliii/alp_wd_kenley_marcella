<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classs;  // Import model Classs
use App\Models\TrainSession; // Import model TrainSession
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
        } else {
            return view('auth.register');
        }
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|confirmed|min:8',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'birth_date' => 'required|date',
        ]);

    // Calculate age
    $birthDate = Carbon::parse($request->birth_date);
    $age = $birthDate->age;

    // Get all classes
    $classes = Classs::all();
    
    if ($classes->isEmpty()) {
        $seeder = new \Database\Seeders\ClasssSeeder();
        $seeder->run();
        $classes = Classs::all();
    }

    // Find appropriate class
    $class = null;
    
    // Strict comparison from oldest to youngest
    if ($age >= 19) {
        $class = Classs::where('class_name', 'Adult')->first();
    } elseif ($age >= 16) {
        $class = Classs::where('class_name', 'KU 18')->first();
    } elseif ($age >= 14) {
        $class = Classs::where('class_name', 'KU 16')->first();
    } elseif ($age >= 12) {
        $class = Classs::where('class_name', 'KU 14')->first();
    } elseif ($age >= 10) {
        $class = Classs::where('class_name', 'KU 12')->first();
    }


    // Create the user with explicit class_id
    $userData = [
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'birth_date' => $request->birth_date,
        'image_profile' => 0,
        'class_id' => $class->id  // Explicitly set the class_id
    ];

        // Create the user
        $user = User::create($userData);
        Auth::login($user);

        // Create TrainSession for the new user
        $this->createTrainSession($user, $class);

        // Redirect to the home page
        return redirect()->route('home', ['id' => $user->id]);
    }

    // Function to determine class name based on age
    private function getClassByAge($age)
    {
        if ($age >= 19) return 'Adult';
        if ($age >= 16) return 'KU 18';
        if ($age >= 14) return 'KU 16';
        if ($age >= 12) return 'KU 14';
        return 'KU 12';
    }

    // Function to create TrainSession
    private function createTrainSession($user, $class)
    {
        $trainSession = new TrainSession();
        $trainSession->class_id = $class->id;
        $trainSession->user_id = $user->id;
        $trainSession->trainsession_date = now();
        $trainSession->start_time = now();
        $trainSession->end_time = now()->addHours(1); // Example duration
        $trainSession->description = 'Training session for new user';
        $trainSession->save();
    }

    // Show login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home', ['id' => Auth::id()]);
        }
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Get the credentials from the request
        $credentials = $request->only('username', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            return redirect()->route('home', ['id' => Auth::id()]);
        }

        return back()->withErrors(['username' => 'The provided credentials do not match our records.']);
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