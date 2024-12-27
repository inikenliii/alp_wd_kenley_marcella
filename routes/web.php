<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainSessionController;
use App\Http\Controllers\UserController;
use App\Models\attendance;
use App\Models\classs;
use App\Models\payment;
use App\Models\trainsession;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/{id}', function ($id) {
    return view('home', [
        "pagetitle" => "Home",
        "id" => (int) $id,
        'user' => User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id),
    ]);
});

Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile');

// Route untuk AttendanceController
Route::resource('/attendance', AttendanceController::class);

// Route untuk TrainSessionController
Route::resource('/session', TrainSessionController::class);

// Route untuk PaymentController
Route::resource('/payment', PaymentController::class);

// Route untuk ClassController
Route::resource('/classs', ClasssController::class);

// Route::middleware('auth')->group(function () {
// });



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