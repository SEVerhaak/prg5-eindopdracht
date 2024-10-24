<x-standard-layout title="Edit User: {{ $user->name }}">
<h1>Edit User: {{ $user->name }}</h1>
    <p>Number of Albums: {{ $user->albums_count }}</p> <!-- Display album count -->

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT') <!-- This indicates that we are sending a PUT request -->

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Show Role Dropdown only for Admins -->
        @if (auth()->user()->role == 1) <!-- Only Admin can change roles -->
        <div>
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Editor</option>
                <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>User</option>
            </select>
        </div>
        @elseif (auth()->user()->role == 2 && $user->role != 1) <!-- If the logged-in user is an Editor and not editing an Admin -->
        <div>
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Editor</option>
                <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>User</option>
            </select>
        </div>
        @endif

        <div>
            <label for="is_public">
                <input type="checkbox" id="is_public" name="is_public" value="1" {{ $user->is_public ? 'checked' : '' }}>
                Is Public
            </label>
        </div>

        <!-- Show Can Be Public Checkbox only for Admins -->
        @if (auth()->user()->role == 1)
            <div>
                <label for="can_be_public">
                    <input type="checkbox" id="can_be_public" name="can_be_public" value="1" {{ $user->can_be_public ? 'checked' : '' }}>
                    Can Be Public
                </label>
            </div>
        @endif

        <button type="submit">Update User</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-standard-layout>
