<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function payments()
    {
        $payments = Payment::all();
        return view('admin.payments', compact('payments'));
    }

    public function destroy(Payment $payment)
    {
        // Delete the payment
        $payment->delete();

        return redirect()->route('admin.payments')->with('success', 'Payment deleted successfully');
    }
}
