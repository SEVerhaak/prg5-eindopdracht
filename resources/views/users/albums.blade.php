<x-standard-layout>
    <h1>Albums of {{ $user->name }}</h1>
    <ul>
        @foreach ($albums as $album)
            <li>
                <h3>
                    {{ $album->name }}
                    @if ($album->album_is_public == 0 && $isAdmin)
                        (hidden)
                    @endif
                </h3>
                <p>Artist: {{ $album->artist }}</p>
                <p>Year: {{ $album->year }}</p>
                <p>Genre: {{ $album->genre->name }}</p>
                @if ($album->image_url)
                    <img src="{{ $album->image_url }}" alt="{{ $album->name }}" style="max-width: 150px; height: auto;">
                @else
                    <p>No image available.</p>
                @endif
                @if (auth()->user()->role == 1)
                    <form action="{{ route('users.destroy', $album->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this album?');">
                            Delete Album
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
<!-- Pagination Links -->
    <div >
        {{ $albums->links('pagination::default') }}
    </div>

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
</x-standard-layout>


