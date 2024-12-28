<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment', [
            'pagetitle' => 'Payments',
            'payment' => 'empty'
        ]);
    }

    public function show($id)
    {
        // Check if the authenticated user id matches the route id
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('payment', [
            'pagetitle' => 'Payment Detail',
            'id' => $id,
            'payment' => payment::where('user_id', $id)->with('user')->get()
        ]);
    }
}
