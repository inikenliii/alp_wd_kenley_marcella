<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        "pagetitle" => "Home",
        //"userDB" =>
    ]);
});

Route::get('/profile/{id}', function ($id) {
    return view('profile', [
        "pagetitle" => "Profile ($id)",
        //"userDB" =>
    ]);
});

Route::get('/attendance', function () {
    return view('attendance', [
        "pagetitle" => "Attendance",
        //"userDB" =>
    ]);
});

Route::get('/session', function () {
    return view('session', [
        "pagetitle" => "Session",
        //"userDB" =>
    ]);
});

Route::get('/payment', function () {
    return view('payment', [
        "pagetitle" => "Payment",
        //"userDB" =>
    ]);
});