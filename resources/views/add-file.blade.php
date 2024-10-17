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
<x-nav-bar>

</x-nav-bar>
<form>
    <form method="POST" action={{route('tests.store')}}>
        @csrf
        <label for="title">Title</label>
        <input type="text" id="title" name="title">

        <label for="artist">Artist</label>
        <input type="text" id="artist" name="artist">

        <label for="year">Year</label>
        <input type="number" min="0" max="2024" step="1" value="2016" />

        <label for="artist">Image</label>
        <input type="file" id="img" name="img" accept="image/*">

        <button type="submit">Opslaan</button>

    </form>
</form>
</body>
</html>
