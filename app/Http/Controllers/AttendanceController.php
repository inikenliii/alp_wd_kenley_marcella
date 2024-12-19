<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.index', [
            'pagetitle' => 'Attendance',
            'attendances' => Attendance::with(['user', 'trainsession'])->get(),
        ]);
    }

    public function show($id)
    {
        return view('attendance.show', [
            'title' => 'Attendance Detail',
            'attendance' => Attendance::with(['user', 'trainsession'])->findOrFail($id),
        ]);
    }
}
