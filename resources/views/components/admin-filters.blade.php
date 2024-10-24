<form method="GET" action="{{ route('users.search') }}" class="mx-20 my-6 flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-4">

    <!-- Search by username -->
    <input type="text" name="query" placeholder="Search username..."
           class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500 w-full max-w-xs"
           value="{{ request('query') }}"> <!-- Retain search value -->


    <!-- Show active users -->
    <div class="flex items-center space-x-2">
        <input type="checkbox" id="active-users" name="active_users" value="1" class="form-checkbox h-5 w-5 text-blue-600" checked
            {{ request('active_users') ? 'checked' : '' }}> <!-- Retain checkbox state -->
        <label for="active-users" class="text-gray-700">Show active users</label>
    </div>

    <!-- Show admin users -->
    <div class="flex items-center space-x-2">
        <input type="checkbox" id="admin-users" name="admin_users" value="1" class="form-checkbox h-5 w-5 text-blue-600" checked
            {{ request('admin_users') ? 'checked' : '' }}> <!-- Retain checkbox state -->
        <label for="admin-users" class="text-gray-700">Show admin users</label>
    </div>

    <!-- Filter Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Search</button>
</form>
