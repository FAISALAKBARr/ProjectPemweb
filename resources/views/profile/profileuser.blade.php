@extends('layouts.app')

@section('title', $user->name . ' - Internet Cafe')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Change Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <small class="text-muted">Leave this field blank if you don't want to change your password.</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                            </div>
                        </form>

                        <hr>

                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('DELETE')

                            <div class="text-center">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">{{ __('Delete Account') }}</button>
                            </div>

                            <!-- Confirm Delete Modal -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">{{ __('Confirm Delete') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ __('Are you sure you want to delete your account? All your data will be permanently removed.') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->role != 'admin')
                <div class="card my-3">
                    <div class="card-header">{{ __('Your Order PC') }}</div>

                    <div class="card-body">
                        <!-- Display Payments -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Place') }}</th>
                                        <th>{{ __('Item Number') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Time') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Proof') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ $payment->place }}</td>
                                            <td>{{ $payment->item_number }}</td>
                                            <td>{{ $payment->date }}</td>
                                            <td>{{ $payment->time }}</td>
                                            <td>{{ $payment->duration }} hours</td>
                                            <td>
                                                @if ($payment->confirmed)
                                                    {{ __('Confirmed') }}
                                                @else
                                                    {{ __('Pending') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($payment->proofPath)
                                                    <a href="{{ Storage::url($payment->proofPath) }}" target="_blank">{{ __('View Proof') }}</a>
                                                @else
                                                    {{ __('No Proof') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">{{ __('No payments found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">{{ __('Your Order Food') }}</div>

                    <div class="card-body">
                        <!-- Display Payments -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Item ID') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Special Requests') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->item_id }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->special_requests }}</td>
                                            <td>
                                                @if ($order->confirmed)
                                                    {{ __('Confirmed') }}
                                                @else
                                                    {{ __('Pending') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection