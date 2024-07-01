<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->id();
        $order->item_id = $request->input('item_id');
        $order->quantity = $request->input('quantity');
        $order->special_requests = $request->input('special_requests');
        $order->save();

        return redirect()->route('order')->with('success', 'Order placed successfully');
    }

    public function byItemId(Request $request)
    {
        $item_id = $request->query('item_id');
        $orders = Order::where('item_id', $item_id)->get();

        return response()->json(['orders' => $orders]);
    }
}
