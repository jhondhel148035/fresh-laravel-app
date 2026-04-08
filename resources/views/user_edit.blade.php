<h2>Edit User</h2>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT') <input type="text" name="first_name" value="{{ $user->first_name }}" required>
    <input type="text" name="last_name" value="{{ $user->last_name }}" required>
    <input type="text" name="middle_name" value="{{ $user->middle_name }}">
    <input type="text" name="nickname" value="{{ $user->nickname }}">
    <input type="email" name="email" value="{{ $user->email }}" required>
    <input type="number" name="age" value="{{ $user->age }}" required>
    <input type="text" name="contact_number" value="{{ $user->contact_number }}" required>
    <textarea name="address" required>{{ $user->address }}</textarea>

    <button type="submit">Update User</button>
    <a href="{{ route('users.index') }}">Cancel</a>
</form>
