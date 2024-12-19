<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index', [
            'pagetitle' => 'Payments',
            'payments' => Payment::with('user')->get(),
        ]);
    }

    public function show($id)
    {
        return view('payment.show', [
            'title' => 'Payment Detail',
            'payment' => Payment::with('user')->findOrFail($id),
        ]);
    }
}