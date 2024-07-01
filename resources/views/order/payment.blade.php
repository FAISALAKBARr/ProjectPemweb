@extends('layouts.app')

@section('content')
{{-- untuk mengunggah bukti pembayaran --}}
<div class="container">
    <h1>Payment for Order #{{ $order->id }}</h1>

    <form action="{{ route('order.payment.process', ['orderId' => $order->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="form-group">
            <label for="proofPath">Upload Payment Proof:</label>
            <input type="file" class="form-control" id="proofPath" name="proofPath" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
@endsection
