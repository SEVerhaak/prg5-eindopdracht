<nav>
    @if (Route::has('login'))

        <a href="{{ route('welcome') }}">Home</a>

        @auth

            <a href="{{ url('/dashboard') }}">Dashboard</a>

            <a href="{{ route('secret') }}">Secret</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                 this.closest('form').submit();">
                                 {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        @else
            <a href="{{ route('login') }}">Log in</a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}">
                    Register
                </a>
            @endif
        @endauth
</nav>
@endif
