<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function byItemId(Request $request)
    {
        $orders = Order::where('item_id', $request->item_id)->get();
        return response()->json(['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->item_id = $request->item_id;
        $order->quantity = $request->quantity;
        $order->special_requests = $request->special_requests;
        $order->save();

        return response()->json(['message' => 'Order saved successfully']);
    }
}
