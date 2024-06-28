@extends('layouts.app')

@section('title', 'Admin - Manage Computers')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Manage Computers</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.computers.add') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Computer Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Computer</button>
                        </form>
                    </div>
                </div>
                <div class="mt-4">
                    <h2 class="text-center mb-4">Existing Computers</h2>
                    <ul class="list-group">
                        @foreach($computers as $computer)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $computer->name }}
                                <form method="POST" action="{{ route('admin.computers.delete', $computer->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
