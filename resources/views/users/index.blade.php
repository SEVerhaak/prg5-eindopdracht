<x-standard-layout>
    <h1>User List</h1>
    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                <p>Number of Albums: {{ $user->albums_count }}</p>

                @if(auth()->check() && (auth()->user()->role == 1 || auth()->user()->role == 2))
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div>
        {{ $users->links() }}
    </div>
</x-standard-layout>
