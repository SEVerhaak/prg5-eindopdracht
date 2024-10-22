<form action="{{ route('search') }}" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="query" placeholder="Search albums..." value="{{ request('query') }}" required>
    <button type="submit">Search</button>
</form>
