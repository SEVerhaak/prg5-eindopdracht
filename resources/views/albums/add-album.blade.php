<x-standard-layout title="Add-Album">
    <div class="w-2/4 mx-auto bg-white p-6 rounded-lg shadow-md m-6">
        <h1 class="text-3xl font-bold mb-6">Upload Page</h1>

        <form method="POST" enctype="multipart/form-data" action={{ route('albums.store') }} class="space-y-4">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-lg font-bold text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Artist -->
            <div>
                <label for="artist" class="block text-lg font-bold text-gray-700">Artist</label>
                <input type="text" id="artist" name="artist" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Year -->
            <div>
                <label for="year" class="block text-lg font-bold text-gray-700">Year</label>
                <input name="year" id="year" type="number" min="0" max="2024" step="1" value="2016" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Image Upload -->
            <div>
                <label for="img" class="block text-lg font-bold text-gray-700">Image</label>
                <input type="file" id="img" name="img" accept="image/*" class="mt-1 block w-full">
            </div>

            <!-- Genre Dropdown -->
            <div>
                <label for="genre" class="block text-lg font-bold text-gray-700">Genre</label>
                <select id="genre" name="genre" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    @foreach ($genre as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Public Checkbox -->
            <div>
                <label for="is_public" class="inline-flex items-center text-lg font-medium text-gray-700">
                    <input type="checkbox" id="is_public" name="is_public" value="1" class="mr-2" checked>
                    Make this album public
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded shadow">Opslaan</button>
            </div>
        </form>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger mt-6">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-standard-layout>
