<?php

namespace App\Http\Controllers;

use App\Models\classs;
use Illuminate\Http\Request;

class ClasssController extends Controller
{
    public function index()
    {
        return view('classs.index', [
            'pagetitle' => 'Classes',
            'classes' => Classs::all(),
        ]);
    }

    public function show($id)
    {
        return view('classs.show', [
            'title' => 'Class Detail',
            'class' => Classs::findOrFail($id),
        ]);
    }
}
