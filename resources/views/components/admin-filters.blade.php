<form method="GET" action="{{ route('users.search') }}" class="mx-20 my-6 flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-4">

    <!-- Search by username -->
    <input type="text" name="query" placeholder="Search username..."
           class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500 w-full max-w-xs"
           value="{{ request('query') }}"> <!-- Retain search value -->


    <!-- Show active users -->


    <!-- Filter Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Search</button>
</form>

<a href="{{ route('users.index') }}" class="text-blue-500 hover:underline mx-20">Reset search</a>

