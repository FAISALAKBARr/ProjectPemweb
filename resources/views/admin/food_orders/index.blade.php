@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Food Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item ID</th>
                <th>Quantity</th>
                <th>Special Requests</th>
                <th>Confirmed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->item_id }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->special_requests }}</td>
                    <td>{{ $order->confirmed ? 'Yes' : 'No' }}</td>
                    <td>
                        @if (!$order->confirmed)
                            <form action="{{ route('admin.food_orders.confirm', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.food_orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
