@props(['secret' => $secret])

@if(auth()->check())
    <p>You are logged in as {{ auth()->user()->name }}.</p>
    <p>Now you can see the list:</p>
    <ul>
            <?php
            foreach ($secret as $x) {
                echo "<li> $x </li>";
            }
            ?>
    </ul>

@else
    <p>You are not logged in.</p>
@endif
