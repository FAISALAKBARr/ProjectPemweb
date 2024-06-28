@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pembayaran</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Place</th>
                <th>Item Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Proof</th>
                <th>Confirmed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->place }}</td>
                    <td>{{ $payment->item_number }}</td>
                    <td>{{ $payment->date }}</td>
                    <td>{{ $payment->time }}</td>
                    <td>{{ $payment->duration }} minutes</td>
                    <td><a href="{{ Storage::url($payment->proofPath) }}" target="_blank">View</a></td>
                    <td>{{ $payment->confirmed ? 'Yes' : 'No' }}</td>
                    <td>
                        @if (!$payment->confirmed)
                            <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="d-inline">
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