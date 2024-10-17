@props(['albums' => $albums])

@if(auth()->check())
    <p>You are logged in as {{ auth()->user()->name }}.</p>
    <p>Now you can see the list:</p>
    <ul>
            <?php

            foreach ($albums as $album) {
                echo "<h3> $album->name </h3>";
                echo "<li>  $album->artist </li>";
                echo "<li>  $album->year </li>";
            }
            ?>
    </ul>

@else
    <p>You are not logged in.</p>
@endif
