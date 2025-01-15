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
        // Ensure the authenticated user is the same as the given ID
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        $trainSessions = TrainSession::with(['classs', 'user'])->where('user_id', $id)->get();
        if (Auth::check() && Auth::user()->isAdmin) {
            $trainSessions = TrainSession::with(['classs', 'user'])->get();
        }

        $allClasses = classs::all();
        $users = User::all();

        return view('session', [
            'pagetitle' => 'Train Sessions',
            'id' => $id,
            'trainSessions' => $trainSessions,
            'allClasses' => $allClasses,
            'users' => $users,
        ]);
    }


    
    // public function create(Request $request)
    // {
    //     // Validasi data yang dikirim
    //     $validatedData = $request->validate([
    //         'class_id' => 'required|exists:classes,id',
    //         'user_id' => 'required|exists:users,id',
    //         'start_time' => 'required|date',
    //         'end_time' => 'required|date|after:start_time',
    //     ]);

    //     // Buat TrainSession baru
    //     $session = TrainSession::create($validatedData);

    //     return back()->with('success', 'Train session created successfully.');
    // }

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

        // Create attendance entry for each user
        Attendance::create([
            'user_id' => $user->id,
            'trainsession_id' => $session->id,
            'attendance_status' => 'absent',  // Default to 'absent'
            'attendance_date' => $request->trainsession_date,
        ]);
    }

    return redirect("/session/" . Auth::id())->with('success', 'Train sessions created successfully for all users in the class.');
}

public function update(Request $request, $id)
{
    $trainSession = TrainSession::findOrFail($id);

    $validatedData = $request->validate([
        'class_id' => 'required|exists:classes,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'trainsession_date' => 'required|date',
        'start_time' => 'nullable|date_format:H:i',
        'end_time' => 'nullable|date_format:H:i|after:start_time',
        'description' => 'nullable|string',
    ]);

    // Save the image if it exists
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('train_sessions', 'public');
        $validatedData['image'] = $imagePath;
    }

    $trainSession->update($validatedData);

    return back();
}


    public function destroy($id)
    {
        $session = TrainSession::findOrFail($id);

        // Hapus TrainSession
        $session->delete();

        return redirect("/session/" . Auth::id());
    }



    
}
