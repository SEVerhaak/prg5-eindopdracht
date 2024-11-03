@props(['genres' => $genres])

<x-standard-layout title="Public Album Overview">
    <h1 class="text-3xl font-bold m-6">Genre Overview</h1>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('delete'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-6" role="alert">
            <strong class="font-bold">Deletion Completed</strong>
            <span class="block sm:inline">{{ session('delete') }}</span>
        </div>
    @endif

    <!-- Add Genre Button -->
    <div class="m-6">
        <a href="{{ route('genres.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Add Genre
        </a>
    </div>

    <!-- Genre Table -->
    <div class="overflow-x-auto m-6">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($genres as $genre)
                <tr class="text-center">
                    <td class="px-4 py-2 border">{{ $genre['id'] }}</td>
                    <td class="px-4 py-2 border">{{ $genre['name'] }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('genres.edit', $genre->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2" onclick="return confirm('Are you sure you want to delete this genre?')">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-standard-layout>

