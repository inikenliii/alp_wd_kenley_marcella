<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainSessionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile');

Route::middleware(['auth', \App\Http\Middleware\SameIdCheck::class])->group(function () {

    Route::get('/home/{id}', function ($id) {
        return view('home', [
            "pagetitle" => "Home",
            "id" => (int) $id,
            'user' => User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id),
        ]);
    })->name('home');

    // Route untuk AttendanceController
    Route::resource('/attendance', AttendanceController::class);

    // Route untuk TrainSessionController
    Route::resource('/session', TrainSessionController::class);

    // Route untuk PaymentController
    Route::resource('/payment', PaymentController::class);

    // Route untuk ClassController
    Route::resource('/classs', ClasssController::class);
});




// Route::get('/dbshow/{id}', function ($id) {
//     return view('dbshow', [
//         'pagetitle' => 'Database Show',
//         'id' => $id,
//         'users' => User::with('classs')->get(),
//         'classes' => classs::all(),
//         'trainsession' => trainsession::all(),
//         'attendence' => attendance::all(),
//         'payments' => payment::with('user')->get(),
//     ]);
// });