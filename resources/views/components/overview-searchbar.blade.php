@props(['genres' => $genres])

<form action="{{ route('overview.search') }}" method="GET" class="flex flex-col md:flex-row md:items-center m-6 space-y-4 md:space-y-0 md:space-x-4">

    <!-- Search Input -->
    <input type="text" name="query" placeholder="Search albums..." value="{{ request('query') }}"
           class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

    <!-- Genre Filter -->
    <select name="genre" id="genre" class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">All Genres</option>
        @foreach ($genres as $g)
            <option value="{{ $g->id }}" {{ request('genre') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
        @endforeach
    </select>

    <!-- Year Filter -->
    <input type="number" name="year" placeholder="Year" value="{{ request('year') }}"
           class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1900" max="{{ date('Y') }}">

    <!-- Rating Filter -->
    <input type="number" name="rating" placeholder="Rating" min="1" max="5" value="{{ request('rating') }}"
           class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

    <!-- Search Button -->
    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
        Search
    </button>
</form>

<!-- Reset Filters Link -->
<a href="{{ route('albums.index') }}" class="text-blue-500 hover:underline m-6">Reset filters</a>
