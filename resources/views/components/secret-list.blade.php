@props(['albums' => $albums])

@if(auth()->check())
    <p>You are logged in as {{ auth()->user()->name }}.</p>
    <p>Now you can see the list:</p>
    <a href="{{route('albums.create')}}">Add album</a>
    <x-search-bar>

    </x-search-bar>
    <ul>
        @foreach ($albums as $album)
            <li>
                <h3>
                    <a href="{{ route('albums.show', $album->id) }}">{{ $album->name }}</a>
                </h3>

                <p>Artist: {{ $album->artist }}</p>
                <p>Year: {{ $album->year }}</p>
                <p>Genre: {{ $album->genre->name }}</p>

                <!-- Display the image, limit the max size -->
                @if ($album->image_url)
                    <img src="{{ $album->image_url }}" alt="{{ $album->name }}"
                         style="max-width: 150px; height: auto;">
                @else
                    <p>No image available for this album.</p>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div >
        {{ $albums->links('pagination::default') }}
    </div>
@else
    <p>You are not logged in.</p>
@endif

<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
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
    }

    .pagination .active span {
        background-color: #4285f4;
        color: white;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }
</style>
