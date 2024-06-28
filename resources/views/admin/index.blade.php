@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <h1>Manajemen Pengguna</h1>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->blocked ? 'Diblokir' : 'Aktif' }}</td>
                            <td>
                                @if ($user->blocked)
                                    <form action="{{ route('admin.unblock', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Aktifkan</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.block', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Blokir</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection
