<?php

namespace App\Http\Controllers;

use App\Models\trainsession;
use Illuminate\Http\Request;

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
        return view('session', [
            'pagetitle' => 'Train Session Detail',
            'id' => $id,
            'sessions'=> TrainSession::with(['classs', 'user'])->findOrFail($id),
        ]);
    }
}
