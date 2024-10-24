@props(['genres' => $genres])

<form action="{{ route('search') }}" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="query" placeholder="Search albums..." value="{{ request('query') }}">

    <!-- Genre Filter -->
    <select name="genre" id="genre">
        <option value="">All Genres</option>
        @foreach ($genres as $g)
            <option value="{{ $g->id }}" {{ request('genre') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
        @endforeach
    </select>

    <!-- Year Filter -->
    <input type="number" name="year" placeholder="Year" value="{{ request('year') }}">

    <!-- Rating Filter -->
    <input type="number" name="rating" placeholder="Rating" min="1" max="5" value="{{ request('rating') }}">

    <button type="submit">Search</button>
</form>
<a href="{{ route('albums.index') }}">Reset filters</a>
