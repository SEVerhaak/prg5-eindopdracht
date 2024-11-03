<x-standard-layout title="Add New Genre">
    <h1 class="text-2xl font-bold m-6">Add a New Genre</h1>

    <form action="{{ route('genres.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 w-full max-w-md mx-auto">
        @csrf

        <!-- Name input -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-xl font-bold mb-2">Genre Name:</label>
            <input type="text" name="name" id="name" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   placeholder="Enter genre name">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Add Genre
        </button>
    </form>
</x-standard-layout>
