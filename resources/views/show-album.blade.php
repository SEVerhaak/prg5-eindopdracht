<x-standard-layout>
    <h1>Album Details</h1>
    <div>
        <h2>Name: {{ $album->name }}</h2>
        <p>Artist: {{ $album->artist }}</p>
        <p>Year: {{ $album->year }}</p>

        <!-- Display the image if it exists -->
        @if($album->image_url)
            <div>
                <img src="{{ $album->image_url }}" alt="{{ $album->name }} Album Cover" style="max-width: 200px; height: auto;">
            </div>
        @else
            <p>No image available</p>
        @endif

        <!-- Display genre name -->
        <p>Genre: {{ $album->genre->name }}</p> <!-- Assuming the genre relationship is defined -->

        <!-- Edit button -->
        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">Edit Album</a>

        <!-- Delete button -->
        <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this album?');">
                Delete Album
            </button>
        </form>
    </div>
</x-standard-layout>
