<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index()
{
    return view('attendance', [
        'pagetitle' => 'Attendance',
        'id' => null,
        'attendances' => Attendance::with(['user', 'trainsession.classs'])->get(),
    ]);
}

    public function show($id)
    {
        // Check if the authenticated user id matches the route id
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('attendance', [
            'pagetitle' => 'Attendance',
            'id' => $id,
            'attendances' => Attendance::with(['user', 'trainsession.classs'])->where('id', $id)->get(),
        ]);
    }
}
