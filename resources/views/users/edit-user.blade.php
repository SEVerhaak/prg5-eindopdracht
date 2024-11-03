<x-standard-layout title="Edit User: {{ $user->name }}">
    <h1 class="text-center text-2xl font-bold m-6">Edit User: {{ $user->name }}</h1>

    <div class="flex justify-center">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 max-w-md w-full">

            <!-- Display Album Count -->
            <p class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-4">Number of Albums: {{ $user->albums_count }}</p>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="font-bold block text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <!-- Role Dropdown (Visible for Admins or Editors) -->
                @if (auth()->user()->role == 1)
                    <div class="mb-4">
                        <label for="role" class="font-bold block text-gray-700 dark:text-gray-300">Role</label>
                        <select id="role" name="role" required
                                class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Editor</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                @elseif (auth()->user()->role == 2 && $user->role != 1)
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 dark:text-gray-300">Role</label>
                        <select id="role" name="role" required
                                class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Editor</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                @endif

                @if (auth()->user()->role == 1)
                <!-- Is Public Checkbox -->
                <div class="mb-4">
                    <label for="is_public" class="inline-flex items-center text-gray-700 dark:text-gray-300">
                        <input type="checkbox" id="is_public" name="is_public" value="1"
                               class="mr-2" {{ $user->is_public ? 'checked' : '' }}>
                        Is Active
                    </label>
                </div>
                @endif
                <!-- Can Be Public Checkbox (Admin Only) -->
                @if (auth()->user()->role == 1)
                    <div class="mb-4">
                        <label for="can_be_public" class="inline-flex items-center text-gray-700 dark:text-gray-300">
                            <input type="checkbox" id="can_be_public" name="can_be_public" value="1"
                                   class="mr-2" {{ $user->can_be_public ? 'checked' : '' }}>
                            Can Set Themselves Active
                        </label>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                        Update User
                    </button>
                </div>
            </form>

            <!-- Error Handling -->
            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-standard-layout>
