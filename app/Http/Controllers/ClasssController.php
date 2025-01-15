<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\classs;
use App\Models\trainsession;
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

        // findorfail = single, get = all
        $trainSession = TrainSession::with(['classs', 'user'])->findOrFail($id);

        if (Auth::check()) {
            if (!Auth::user()->isAdmin) {
                if (Auth::id() != $trainSession->user->id) {
                    abort(403, 'Unauthorized action.');
                }
            }
        }

        $allClasses = classs::all();
        $users = User::all();

        return view('sessiondetail', [
            'pagetitle' => 'Train Session Details',
            'trainSession' => $trainSession,
            'allClasses' => $allClasses,
            'users' => $users
        ]);

        // return view('classs', [
        //     'pagetitle' => 'Classes',
        //     'id' => $id,
        //     'class' => classs::with(['users', 'trainsessions'])->get()
        // ]);
    }
}
