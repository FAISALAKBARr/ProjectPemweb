@extends('layouts.app')

@section('title', 'Choose Place')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Choose Your Place</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('places.select') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="place" class="form-label">Select Place:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="form-select" id="place" name="place" required>
                                        <option value="Regular">Regular</option>
                                        <option value="Pro">Pro</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Proceed to PC Selection</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
