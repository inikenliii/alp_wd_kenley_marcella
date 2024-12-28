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
        'id' => null,
        'attendances' => Attendance::with(['user', 'trainsession.classs'])->get(),
    ]);
}

    public function show($id)
    {
    
        return view('attendance', [
            'pagetitle' => 'Attendance',
            'id' => $id,
            'attendances' => Attendance::with(['user', 'trainsession.classs'])->where('id', $id)->get(),
        ]);
    }
}
