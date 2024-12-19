<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'pagetitle' => 'Users',
            'users' => User::with('classs')->get(),
        ]);
    }

    public function show($id)
    {
        return view('user.show', [
            'title' => 'User Detail',
            'user' => User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id),
        ]);
    }
}
