<x-standard-layout title="Users">
<h1>User List</h1>
    <!-- Link to edit the logged-in user's account -->
    <div class="mb-4">
        <a href="{{ route('users.edit', auth()->id()) }}" class="text-blue-500">
            Edit Your Account
        </a>
    </div>
    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                <p>Number of Albums: {{ $user->albums_count }}</p>

                <!-- Indicate if the user is hidden -->
                @if ($user->is_public == 0)
                    <span class="text-red-500">(Not public)</span>
                @endif

                <!-- Show edit button if the logged-in user is an admin -->
                @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                    <a href="{{ route('users.edit', $user->id) }}" class="ml-2 text-blue-500">Edit</a>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div>
        {{ $users->links() }}
    </div>
</x-standard-layout>
