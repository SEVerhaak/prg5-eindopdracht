<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Left side (Home) -->
        <div class="text-white">
            <a href="{{ route('welcome') }}" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                Home
            </a>
        </div>

        <!-- Right side (Login/Logout and other links) -->
        @if (Route::has('login'))
            <div class="space-x-4 flex items-center">
                <a href="{{ route('overview.index') }}" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                    Overview
                </a>
                @auth

                    <a href="{{ route('albums.index') }}" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        My Albums
                    </a>

                    <a href="{{ route('users.index') }}" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        Users
                    </a>

                    <a href="{{ url('/dashboard') }}" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                        Dashboard
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-red-600">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                @else
                    <!-- Login and Register buttons -->
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-green-500 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-green-600">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>
