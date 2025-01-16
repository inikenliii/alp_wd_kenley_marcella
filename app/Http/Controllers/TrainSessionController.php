<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classs;
use App\Models\TrainSession;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainSessionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $userSessions = TrainSession::with(['classs', 'user'])
            ->where('user_id', $userId)
            ->get();

        $allSessions = TrainSession::with(['classs', 'user'])->get();

        $allClasses = Classs::all();

        return view('session', [
            'pagetitle' => 'Train Sessions',
            'id' => $userId,
            'trainSessions' => $userSessions,
            'allSessions' => $allSessions,
            'allClasses' => $allClasses,
        ]);
    }

    public function show($id)
    {
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

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'image' => 'nullable|image|max:2048',
            'trainsession_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'description' => 'nullable|string',
        ]);

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

        return redirect("/session/". Auth::id())->with('success', 'Train sessions created successfully for all users in the class.');
    }
}