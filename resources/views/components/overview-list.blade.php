
<!-- Albums Grid -->
<ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 m-6">
    @foreach ($albums as $album)
        <li class="bg-white rounded-lg shadow-md p-4">
            <!-- Display the user who posted the album -->
            <p class="text-gray-800 font-semibold">
                <a href="{{ route('users.show', $album->user->id) }}" class="text-blue-600 hover:underline">
                    Posted by: {{ $album->user->name }}
                </a>
            </p>            <p class="text-gray-800 font-semibold">Artist: {{ $album->artist }}</p>
            <p class="text-gray-600">Year: {{ $album->year }}</p>
            <p class="text-gray-600">Genre: {{ $album->genre->name }}</p>

            <!-- Display the image with max size -->
            @if ($album->image_url)
                <img src="{{ $album->image_url }}" alt="{{ $album->name }}"
                     class="my-3 max-w-full h-auto rounded-md">
            @else
                <img src="/storage/images/placeholder.png" alt="placeholder"
                     class="my-3 max-w-full h-auto rounded-md">
            @endif

            <a href="{{ route('albums.show', $album->id) }}"
               class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded my-3 block text-center">
                View {{ $album->name }}
            </a>
        </li>
    @endforeach
</ul>

<!-- Pagination Links -->
<div class="mt-6">
    {{ $albums->links('pagination::default') }}
</div>

<!-- only way styling would work :( -->
<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
        margin-bottom: 5rem;
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
        border-radius: 0.5rem;
    }

    .pagination .active span {
        background-color: #4285f4;
        color: white;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }
</style>
