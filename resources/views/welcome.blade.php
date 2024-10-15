<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
    <header>
        <x-nav-bar>

        </x-nav-bar>
    </header>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <h1>Home Page</h1>
    @if(auth()->check())
        <p>You are logged in as {{ auth()->user()->name }}.</p>
    @else
        <p>You are not logged in.</p>
    @endif
    </body>
</html>
