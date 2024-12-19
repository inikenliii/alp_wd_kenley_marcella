<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance', [
            'pagetitle' => 'Attendance',
            'attendances' => Attendance::with(['user', 'trainsession'])->get(),
        ]);
    }

    public function show($id)
    {
        return view('attendance', [
            'pagetitle' => 'Attendance Detail',
            'id' => $id,
            'attendance' => Attendance::with(['user', 'trainsession'])->findOrFail($id),
        ]);
    }
}
