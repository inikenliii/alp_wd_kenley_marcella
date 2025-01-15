<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainSessionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home page redirection
Route::get('/', function () {
    return redirect('/login');
});

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register']);

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home/{id}', function ($id) {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }
        return view('home', [
            'pagetitle' => 'Home',
            'id' => $id,
            'user' => User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id),
        ]);
    })->name('home');

    Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile');
    Route::resource('/user', UserController::class);

    // Routes for AttendanceController
    Route::resource('/attendance', AttendanceController::class);

    // Routes for TrainSessionController
    Route::resource('/session', TrainSessionController::class);

    // Routes for PaymentController
    Route::resource('/payment', PaymentController::class);

    // Routes for ClassController
    Route::resource('/classs', ClasssController::class);
});
