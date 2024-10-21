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

                    <!-- Display the image, limit the max size -->
                    @if ($album->image_url)
                        <img src="{{ $album->image_url }}" alt="{{ $album->name }}"
                             style="max-width: 150px; height: auto;">
                    @else
                        <p>No image available for this album.</p>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
@else
    <p>You are not logged in.</p>
@endif
