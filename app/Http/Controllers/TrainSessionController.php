<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\classs;
use App\Models\trainsession;
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

        return view('sessions.index', [
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

        // Fetch all classes for the create modal dropdown
        $allClasses = classs::all();
        $users = User::all(); // Fetch all users for the trainer dropdown

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
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:2048',
            'trainsession_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('train_sessions', 'public') : null;

        TrainSession::create([
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'image' => $imagePath,
            'trainsession_date' => $request->trainsession_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
        ]);

        return redirect("/session/" . Auth::id());
    }


    public function update(Request $request, $id)
    {
        $session = TrainSession::findOrFail($id);

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'trainsession_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);

        // Perbarui TrainSession
        $session->update($validatedData);

        return back()->with('success', 'Train session updated successfully.');
    }

    public function delete($id)
    {
        $session = TrainSession::findOrFail($id);

        // Hapus TrainSession
        $session->delete();

        return back()->with('success', 'Train session deleted successfully.');
    }



    
}
