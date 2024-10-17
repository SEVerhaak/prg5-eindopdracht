@props(['albums' => $albums])

@if(auth()->check())
    <p>You are logged in as {{ auth()->user()->name }}.</p>
    <p>Now you can see the list:</p>
    <ul>

        @foreach ($albums as $album)
            <li>
                <h3>{{ $album->genre->name }}</h3>
                <p>Artist: {{ $album->artist }}</p>
                <p>Year: {{ $album->year }}</p>
            </li>
        @endforeach
    </ul>

@else
    <p>You are not logged in.</p>
@endif
