<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;

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
        return view('payment', [
            'pagetitle' => 'Payment Detail',
            'id' => $id,
            'payment' => payment::where('user_id', $id)->with('user')->get()
        ]);
    }
}
