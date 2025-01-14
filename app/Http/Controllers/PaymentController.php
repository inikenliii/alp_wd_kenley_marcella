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

        $payment = payment::where('user_id', $id)->with('user')->get();
        if (Auth::check() && Auth::user()->isAdmin) {
            $payment = payment::all();
        }

        return view('payment', [
            'pagetitle' => 'Payment Detail',
            'id' => $id,
            'payment' => $payment
        ]);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        if ($payment->payment_status === 'pending') {
            $payment->payment_status = 'paid';
            $payment->save();

            return back()->with('success', 'Payment status updated to paid.');
        }

        return back()->with('error', 'Payment status is already paid.');
    }
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        // Check if the authenticated user is authorized to delete the payment
        if (Auth::id() != $payment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the payment
        $payment->delete();

        return back()->with('success', 'Payment deleted successfully.');
    }
}
