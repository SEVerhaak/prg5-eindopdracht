@if(auth()->check())
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <a href="{{ route('albums.index') }}">Go to my albums!</a>
@else
    <p>Welcome to the site!</p>
    <a href="{{ route('login') }}">login</a>
@endif
