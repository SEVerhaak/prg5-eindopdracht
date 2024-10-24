<form method="GET" action="{{ route('users.index') }}" class="flex items-center space-x-4 mx-20 my-6">
    <input type="text" name="query" placeholder="Search..."
           class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500 w-full max-w-xs"
           required>

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">
        Search
    </button>
</form>
