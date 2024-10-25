<x-standard-layout title="{{ $album->name }}">
    <h1 class="text-center text-2xl font-bold m-6">Album Details</h1>
    <div class="flex justify-center">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
            <h2 class="text-xl font-semibold">Name: {{ $album->name }}</h2>
            <p class="text-gray-600">Artist: {{ $album->artist }}</p>
            <p class="text-gray-600">Year: {{ $album->year }}</p>
            <!-- Display genre name -->
            <p class="text-gray-600">Genre: {{ $album->genre->name }}</p>
            <!-- Display the image if it exists -->
            @if(!$album->album_is_public)
                <p class="text-red-500">Hidden</p>
            @else
                <p class="text-green-500">Public</p>
            @endif
            @if($album->image_url)
                <div class="mt-4">
                    <img src="{{ $album->image_url }}" alt="{{ $album->name }} Album Cover" class="max-w-full h-auto rounded-md">
                </div>
            @else
                <img src="/storage/images/placeholder.png" alt="placeholder" class="my-3 max-w-full h-auto rounded-md">
            @endif

            <!-- Show edit and delete buttons only if the logged-in user is the album owner -->
            @if(auth()->check() && auth()->id() === $album->user_id)
                <a href="{{ route('albums.edit', $album->id) }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Edit Album</a>

                <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mt-4 inline-block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition" onclick="return confirm('Are you sure you want to delete this album?');">
                        Delete Album
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-standard-layout>
