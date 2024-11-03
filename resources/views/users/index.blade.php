<x-standard-layout title="Users">
    <div class="max-w-3/4 mx-auto"> <!-- Center the content and limit to 3/4 width -->
        <h1 class="text-3xl font-bold mx-20 my-10">User List</h1>

        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <x-admin-filters>
            </x-admin-filters>
        @else
            <x-user-search>
            </x-user-search>
        @endif

        <!-- Users List -->
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mx-20">
            @foreach ($users as $user)
                <li class="p-6 bg-white shadow-md rounded-lg flex flex-col justify-between">
                    <div>
                        <a href="{{ route('users.show', $user->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                            {{ $user->name }}
                        </a>
                        <p class="text-gray-500">Number of Albums: {{ $user->albums_count }}</p>

                        <!-- Indicate if the user is hidden -->
                        @if ($user->is_public == 0)
                            <span class="text-red-500 text-sm font-medium">(Not Active)</span>
                        @else
                            <span class="text-green-500 text-sm font-medium">(Active)</span>
                        @endif
                    </div>

                    <!-- Toggle for setting user to public -->
                    @if (auth()->user()->role == 1)
                        <form action="{{ route('users.togglePublic', $user->id) }}" method="POST" class="flex items-center mt-4">
                            @csrf
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_public" value="1" {{ $user->is_public ? 'checked' : '' }} class="sr-only peer" onchange="this.form.submit();">
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </form>
                    @endif

                    <!-- Show edit button if the logged-in user is an admin -->
                    @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                        <a href="{{ route('users.edit', $user->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded shadow mt-4">
                            Edit
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $users->links('pagination::default') }}
        </div>
    </div> <!-- End of centered container -->
</x-standard-layout>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
        margin-bottom: 5rem;
    }

    .pagination li {
        margin: 0 5px; /* Add space between items */
    }

    .pagination a, .pagination span {
        padding: 10px 15px;
        border: 1px solid #ddd;
        text-decoration: none;
        background-color: #fff;
        color: #333;
        border-radius: 0.5rem;
    }

    .pagination .active span {
        background-color: #4285f4;
        color: white;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }
</style>
