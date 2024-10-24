<x-standard-layout title="Edit-Album">
    <h1 class="text-center text-2xl font-bold m-6">Edit Album</h1>
    <div class="flex justify-center m-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 max-w-md w-full">
            <form method="POST" enctype="multipart/form-data" action="{{ route('albums.update', $album->id) }}">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300">Title</label>
                    <input value="{{ $album->name }}" type="text" id="title" name="title" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <!-- Artist Input -->
                <div class="mb-4">
                    <label for="artist" class="block text-gray-700 dark:text-gray-300">Artist</label>
                    <input value="{{ $album->artist }}" type="text" id="artist" name="artist" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <!-- Year Input -->
                <div class="mb-4">
                    <label for="year" class="block text-gray-700 dark:text-gray-300">Year</label>
                    <input value="{{ $album->year }}" name="year" id="year" type="number" min="0" max="2024" step="1" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                </div>

                <!-- Current Image -->
                @if($album->image_url)
                    <div class="mb-4">
                        <img src="{{ $album->image_url }}" alt="Album Image" class="max-w-full h-auto rounded-md">
                    </div>
                @else
                    <img src="/storage/images/placeholder.png" alt="placeholder" class="my-3 max-w-full h-auto rounded-md">
                @endif

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="img" class="block text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" id="img" name="img" accept="image/*" class="mt-2 p-2 border rounded w-full dark:bg-gray-700 dark:text-gray-300">
                </div>

                <!-- Genre Dropdown -->
                <div class="mb-4">
                    <label for="genre" class="block text-gray-700 dark:text-gray-300">Genre</label>
                    <select id="genre" name="genre" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                        @foreach ($genre as $g)
                            <option value="{{ $g->id }}" {{ $g->id == $album->genre_id ? 'selected' : '' }}>
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Save Changes</button>
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
