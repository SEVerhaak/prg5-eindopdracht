@props(['genres' => $genres, 'query' => $query])

<form action="{{ route('overview.store') }}" method="POST" class="flex flex-col md:flex-row md:items-center m-6 space-y-4 md:space-y-0 md:space-x-4">
    @csrf <!-- Include CSRF token for security -->

    <!-- Search Input -->
    <div class="flex-1">
        <input type="text" name="search" placeholder="Search public albums..."
               value="{{ old('search', $query) }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <!-- Genre Filter -->
    <select name="genre" id="genre" class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">All Genres</option>
        @foreach ($genres as $g)
            <option value="{{ $g->id }}" {{ request('genre') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
        @endforeach
    </select>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Search
    </button>
</form>

