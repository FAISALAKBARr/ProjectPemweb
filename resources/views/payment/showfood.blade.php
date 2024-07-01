@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Payment Details Order Food</h2>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @php
                    $itemNumber = request('item_number');
                    $date = request('date');
                    $time = request('time');
                    $price = 0; // Set a default price if duration is not defined
                @endphp
                <h4 class="card-title text-success">Price: ${{ number_format($price, 2) }}</h4>
                <p class="card-text"><strong>Item Number:</strong> {{ $itemNumber }}</p>
                <p class="card-text"><strong>Date:</strong> {{ $date }}</p>
                <p class="card-text"><strong>Time:</strong> {{ $time }}</p>
            </div>
        </div>

        <form id="paymentForm" action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="amount" value="{{ $price }}">
            <input type="hidden" name="place" value="{{ $place ?? '' }}">
            <input type="hidden" name="item_number" value="{{ $itemNumber }}">
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="time" value="{{ $time }}">
            <input type="hidden" name="duration" value="{{ $duration ?? '' }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group mb-3">
                <label for="proofPath" class="form-label">Upload Payment Proof:</label>
                <input type="file" class="form-control" id="proofPath" name="proofPath" required>
                <div class="invalid-feedback">
                    Please upload your payment proof.
                </div>
            </div>
            <button type="button" class="btn btn-success w-100" onclick="showConfirmationModal()">Submit Payment Proof</button>
        </form>
    </div>

    <!-- Modal for confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Payment Submitted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your payment proof has been submitted. Please wait for admin confirmation.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }

        function submitForm() {
            const form = document.getElementById('paymentForm');
            form.submit();
        }

        // Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
