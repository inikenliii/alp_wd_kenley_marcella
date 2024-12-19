<?php

namespace App\Http\Controllers;

use App\Models\trainsession;
use Illuminate\Http\Request;

class TrainSessionController extends Controller
{
    public function index()
    {
        return view('trainsession.index', [
            'pagetitle' => 'Train Sessions',
            'sessions' => TrainSession::with(['classs', 'user'])->get(),
        ]);
    }

    public function show($id)
    {
        return view('trainsession.show', [
            'title' => 'Train Session Detail',
            'session' => TrainSession::with(['classs', 'user'])->findOrFail($id),
        ]);
    }
}
