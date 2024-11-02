<x-standard-layout title="Albums of {{ $user->name }}">
    <h1 class="text-3xl font-bold m-6">Albums of {{ $user->name }}</h1>
    <ul class="m-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($albums as $album)
            <li class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold">
                    <a href="{{ route('albums.show', $album->id) }}" class="text-blue-500 hover:underline">
                        {{ $album->name }}
                        @if ($album->album_is_public == 0 && $isAdmin)
                            <span class="text-red-500 text-sm font-medium">(hidden)</span>
                        @endif
                    </a>
                </h3>
                <p class="text-gray-600">Artist: {{ $album->artist }}</p>
                <p class="text-gray-600">Year: {{ $album->year }}</p>
                <p class="text-gray-600">Genre: {{ $album->genre->name }}</p>

                @if ($album->image_url)
                    <img src="{{ $album->image_url }}" alt="{{ $album->name }}"
                         class="mt-4 max-w-full h-auto rounded-lg">
                @else
                    <img src="/storage/images/placeholder.png" alt="placeholder"
                         class="my-3 max-w-full h-auto rounded-md">
                @endif

                @if (auth()->user()->role == 1)
                    <form action="{{ route('users.destroy', $album->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full text-white bg-red-500 hover:bg-red-600 font-bold py-2 px-4 rounded shadow"
                                onclick="return confirm('Are you sure you want to delete this album?');">
                            Delete Album
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</x-standard-layout>


<!-- Pagination Links -->
<div>
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


