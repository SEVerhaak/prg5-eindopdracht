<x-standard-layout title="Users">
    <h1 class="text-3xl font-bold mb-6">User List</h1>

    <!-- Link to edit the logged-in user's account -->
    <div class="mb-6">
        <a href="{{ route('profile.edit') }}" class="text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded shadow">
            Edit Your Account
        </a>
    </div>

    <!-- Users List -->
    <ul class="space-y-4">
        @foreach ($users as $user)
            <li class="p-6 bg-white shadow-md rounded-lg flex justify-between items-center">
                <div>
                    <a href="{{ route('users.show', $user->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                        {{ $user->name }}
                    </a>
                    <p class="text-gray-500">Number of Albums: {{ $user->albums_count }}</p>

                    <!-- Indicate if the user is hidden -->
                    @if ($user->is_public == 0)
                        <span class="text-red-500 text-sm font-medium">(Not Active)</span>
                    @endif
                </div>

                <!-- Show edit button if the logged-in user is an admin -->
                @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                    <a href="{{ route('users.edit', $user->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded shadow ml-4">
                        Edit
                    </a>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div class="mt-8">
        {{ $users->links() }}
    </div>

</x-standard-layout>
