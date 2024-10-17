@props(['albums' => $albums])

@if(auth()->check())
    <p>You are logged in as {{ auth()->user()->name }}.</p>
    <p>Now you can see the list:</p>
    <ul>
        @foreach ($albums as $album)
            @if($album->user->id === auth()->user()->id)
                <li>
                    <h3>{{ $album->name }}</h3>
                    <p>Artist: {{ $album->artist }}</p>
                    <p>Year: {{ $album->year }}</p>
                    <p>Genre: {{ $album->genre->name }}</p>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <p>You are not logged in.</p>
@endif
