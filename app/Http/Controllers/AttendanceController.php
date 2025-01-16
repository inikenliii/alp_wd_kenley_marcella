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

        $attendance = Attendance::with(['user', 'trainsession.classs'])->where('user_id', $id)->get();
        if (Auth::check() && Auth::user()->isAdmin) {
            $attendance = attendance::all();
        }

        return view('attendance', [
            'pagetitle' => 'Attendance',
            'id' => $id,
            'attendances' => $attendance,
        ]);
    }
    
    public function create(Request $request)
    {
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'trainsession_id' => 'required|exists:trainsessions,id',
            'attendance_status' => 'required|in:present,absent',
            'attendance_date' => 'required|date',
        ]);

        // Buat attendance baru
        Attendance::create($validatedData);

        return back()->with('success', 'Attendance created successfully.');
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'attendance_status' => 'required|in:present,absent',
        ]);

        // Perbarui attendance
        $attendance->update($validatedData);

        return back()->with('success', 'Attendance updated successfully.');
    }
    
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);

        // Hapus attendance
        $attendance->delete();

        return back()->with('success', 'Attendance deleted successfully.');
    }



}
