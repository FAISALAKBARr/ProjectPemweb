<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminFoodOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.food_orders.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.food_orders')->with('success', 'Order deleted successfully');
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->confirmed = true;
        $order->save();

        return redirect()->route('admin.food_orders');
    }

    public function payments()
    {
        $payments = Payment::all();
        return view('admin.payments', compact('payments'));
    }

    public function destroyPayment(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments')->with('success', 'Payment deleted successfully');
    }

    public function confirmPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->confirmed = true;
        $payment->save();

        return redirect()->route('admin.payments');
    }
}
