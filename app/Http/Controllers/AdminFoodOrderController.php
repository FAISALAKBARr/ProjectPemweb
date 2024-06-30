<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    //     public function foodOrders()
    // {
    //     $orders = Order::all();
    //     return view('admin.food_orders', compact('orders'));
    // }

    // public function destroyOrder(Order $order)
    // {
    //     $order->delete();
    //     return redirect()->route('admin.food_orders')->with('success', 'Order deleted successfully');
    // }

    // public function confirmOrder($id)
    // {
    //     $order = Order::findOrFail($id);
    //     $order->confirmed = true;
    //     $order->save();

    //     return redirect()->route('admin.food_orders');
    // }
}
