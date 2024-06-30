<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function showPaymentForm($orderId)
    {
        $order = Order::findOrFail($orderId); // Fetch the order correctly
        // $order->payment()->update(['confirmed' => true]);
        return view('payment.showfood', compact('order'));
    }

    public function processPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        $request->validate([
            'proofPath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'required|numeric',
        ]);

        // if ($request->hasFile('proofPath')) {
        //     $proofPath = $request->file('proofPath')->store('proofPaths', 'public');
        // }
        $path = $request->file('proofPath')->store('payments', 'public');

        Payment::create([
            // 'user_id' => auth()->user()->id,
            // 'amount' => $request->amount,
            // 'order_id' => $orderId,
            // 'place' => 'Food Order',
            // 'item_number' => $orderId,
            // 'date' => Carbon::now()->format('Y-m-d'),
            // 'time' => Carbon::now()->format('H:i:s'),
            // // 'duration' => 0, // Duration is not needed for food orders
            // 'proofPath' => $proofPath,
            // 'confirmed' => false,

            'user_id' => auth()->id(),
            'order_id' => $orderId,
            'amount' => $request->amount,
            'proofPath' => $path,
            'confirmed' => false,

        ]);

        return redirect('/')->with('success', 'Your payment proof has been submitted. Please wait for admin confirmation.');
    }
}
