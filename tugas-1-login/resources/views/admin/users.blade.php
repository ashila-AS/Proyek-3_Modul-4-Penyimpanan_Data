<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Role Management</title>
</head>
<body>
    <h1>Role Management</h1>
    <p>Login sebagai: {{ auth()->user()->username }} ({{ auth()->user()->role }})</p>

    @if (session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Ubah role</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.role.update', $u) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="customer" @selected($u->role === 'customer')>customer</option>
                            <option value="staff" @selected($u->role === 'staff')>staff</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>