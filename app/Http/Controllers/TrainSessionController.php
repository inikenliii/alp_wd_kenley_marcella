<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\classs;
use App\Models\trainsession;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainSessionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch all sessions and user-specific sessions
        $allSessions = TrainSession::with(['classs', 'user'])->get();
        $userSessions = TrainSession::with(['classs', 'user'])
            ->where('user_id', $userId)
            ->get();

        return view('session', [
            'pagetitle' => 'Train Sessions',
            'id' => $userId,
            'allSessions' => $allSessions,
            'userSessions' => $userSessions,
        ]);
    }

    public function show($id)
{
    $trainSession = TrainSession::with(['classs', 'user'])->findOrFail($id);

    return view('train_session.show', [
        'trainSession' => $trainSession,
    ]);
}

    public function store(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:classes,id',
        'image' => 'nullable|image|max:2048',
        'trainsession_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'description' => 'nullable|string',
    ]);

    // Simpan gambar jika ada
    $imagePath = $request->file('image') ? $request->file('image')->store('train_sessions', 'public') : null;

    // Ambil semua pengguna dalam kelas yang ditentukan
    $users = User::where('class_id', $request->class_id)->get();

    if ($users->isEmpty()) {
        return back()->withErrors(['class_id' => 'No users are enrolled in the selected class.']);
    }

    // Buat sesi pelatihan untuk setiap pengguna
    foreach ($users as $user) {
        $session = TrainSession::create([
            'class_id' => $request->class_id,
            'user_id' => $user->id,
            'image' => $imagePath,
            'trainsession_date' => $request->trainsession_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
        ]);

<<<<<<< HEAD
<<<<<<< HEAD
        $imagePath = $request->file('image') ? $request->file('image')->store('train_sessions', 'public') : null;

        $users = User::where('class_id', $request->class_id)->get();

        if ($users->isEmpty()) {
            return back()->withErrors(['class_id' => 'No users are enrolled in the selected class.']);
        }

        foreach ($users as $user) {
            $session = TrainSession::create([
                'class_id' => $request->class_id,
                'user_id' => $user->id,
                'image' => $imagePath,
                'trainsession_date' => $request->trainsession_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'description' => $request->description,
            ]);

            Attendance::create([
                'user_id' => $user->id,
                'trainsession_id' => $session->id,
                'attendance_status' => 'absent',
                'attendance_date' => $request->trainsession_date,
            ]);
        }

        return redirect("/session" . Auth::id())->with('success', 'Train sessions created successfully for all users in the class.');
=======
=======
>>>>>>> parent of 4a6556c (ini ya)
        // Create attendance entry for each user
        Attendance::create([
            'user_id' => $user->id,
            'trainsession_id' => $session->id,
            'attendance_status' => 'absent',  // Default to 'absent'
            'attendance_date' => $request->trainsession_date,
        ]);
<<<<<<< HEAD
>>>>>>> parent of 4a6556c (ini ya)
=======
>>>>>>> parent of 4a6556c (ini ya)
    }

        return redirect("/session" . Auth::id())->with('success', 'Train sessions created successfully for all users in the class.');
    }
}
