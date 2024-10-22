<x-standard-layout>
    <h1>EDIT</h1>
    <form method="POST" enctype="multipart/form-data" action={{ route('albums.update', $album->id) }}>
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <input value="{{ $album->name }}" type="text" id="title" name="title">

        <label for="artist">Artist</label>
        <input value="{{ $album->artist }}" type="text" id="artist" name="artist">

        <label for="year">Year</label>
        <input value="{{ $album->year }}" name="year" id="year" type="number" min="0" max="2024" step="1"/>

        <!-- Display the current image if it exists -->
        @if($album->image_url)
            <div>
                <img src="{{ $album->image_url }}" alt="Album Image" style="max-width: 150px; height: auto;">
            </div>
        @else
            <p>No image available</p>
        @endif

        <label for="img">Image</label>
        <input type="file" id="img" name="img" accept="image/*">

        <!-- Genre Dropdown -->
        <label for="genre">Genre</label>
        <select id="genre" name="genre">
            @foreach ($genre as $g)
                <option value="{{ $g->id }}" {{ $g->id == $album->genre_id ? 'selected' : '' }}>
                    {{ $g->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Opslaan</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-standard-layout>
