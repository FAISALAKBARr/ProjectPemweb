<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
</head>
<body>
    <h1>Users</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->blocked)
                            <form method="POST" action="{{ route('admin.users.unblock', $user->id) }}">
                                @csrf
                                <button type="submit">Unblock</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.users.block', $user->id) }}">
                                @csrf
                                <button type="submit">Block</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
