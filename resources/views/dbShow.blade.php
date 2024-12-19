<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('notFound');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('profile', [
            'pagetitle' => $user->username . ' Detail',
            'user' => User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id),
        ]);
    }
}