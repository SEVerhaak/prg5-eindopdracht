<x-standard-layout title="Edit Genre">
    <h1 class="text-2xl font-bold m-6">Edit Genre</h1>

    <!-- Update form with prefilled genre name -->
    <form action="{{ route('genres.update', $genre->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 w-full max-w-md mx-auto">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <!-- Name input -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-xl font-bold mb-2">Genre Name:</label>
            <input type="text" name="name" id="name" required
                   value="{{ old('name', $genre->name) }}"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter genre name">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update Genre
        </button>
    </form>
</x-standard-layout>
