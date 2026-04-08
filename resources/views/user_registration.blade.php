<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .btn-delete { color: red; }
        .btn-edit { color: blue; }
    </style>
</head>
<body>

    <h2>User Registration</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="middle_name" placeholder="Middle Name">
        </div>
        <div class="form-group">
            <input type="text" name="nickname" placeholder="Nickname">
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Age" required>
        </div>
        <div class="form-group">
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <textarea name="address" placeholder="Full Address" required></textarea>
        </div>
        <button type="submit">Save User</button>
    </form>

    <hr>

    <h2>Registered Users</h2>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                <td>{{ $user->nickname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a> | 
                    
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>