<?php

namespace App\Http\Controllers;

use App\Models\trainsession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainSessionController extends Controller
{
    public function index()
    {
        return view('session', [
            'pagetitle' => 'Train Sessions',
            'sessions' => TrainSession::with(['classs', 'user'])->get(),
        ]);
    }

    public function show($id)
    {
        // Check if the authenticated user id matches the route id
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }
        return view('session', [
            'pagetitle' => 'Train Session Detail',
            'id' => $id,
            'sessions' => TrainSession::with(['classs', 'user'])->where('id', $id)->get(),  // Ini akan mengembalikan collection
        ]);
    }
}
