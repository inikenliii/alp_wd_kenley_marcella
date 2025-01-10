<?php

namespace App\Http\Controllers;

use App\Models\classs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasssController extends Controller
{
    public function index()
    {
        return view('classs', [
            'pagetitle' => 'Classes',
            'classes' => Classs::all(),
        ]);
    }

    public function show($id)
    {
        // Check if the authenticated user id matches the route id
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('classs', [
            'pagetitle' => 'Classes',
            'class' => Classs::all(),
        ]);
    }
}
