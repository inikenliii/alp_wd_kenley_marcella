<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainSessionController;
use App\Http\Controllers\UserController;
use App\Models\payment;
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
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/{id}', [AttendanceController::class, 'show'])->name('attendance.show');

// Route untuk TrainSessionController
Route::get('/session', [TrainSessionController::class, 'index'])->name('session.index');
Route::get('/session/{id}', [TrainSessionController::class, 'show'])->name('session.show');

// Route untuk PaymentController
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

// Route untuk ClassController
Route::get('/classs', [ClasssController::class, 'index'])->name('classs.index');
Route::get('/classs/{id}', [ClasssController::class, 'show'])->name('classs.show');

Route::get('/dbshow/{id}', function ($id) {
    return view('dbshow', [
        'pagetitle' => 'Database Show',
        'id' => $id,
        'users' => User::with('classs')->get(),
        'payments' => payment::with('payment')->get(),
    ]);
});