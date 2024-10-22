<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <header>
        <x-nav-bar></x-nav-bar>
    </header>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<h1>Upload Page</h1>

<form method="POST" enctype="multipart/form-data" action={{ route('albums.store') }}>
    @csrf
    <label for="title">Title</label>
    <input type="text" id="title" name="title">

    <label for="artist">Artist</label>
    <input type="text" id="artist" name="artist">

    <label for="year">Year</label>
    <input name="year" id="year" type="number" min="0" max="2024" step="1" value="2016"/>

    <label for="img">Image</label>
    <input type="file" id="img" name="img" accept="image/*">

    <!-- Genre Dropdown -->
    <label for="genre">Genre</label>
    <select id="genre" name="genre">
        @foreach ($genre as $g)
            <option value="{{ $g->id }}">{{ $g->name }}</option>
        @endforeach
    </select>

    <button type="submit">Opslaan</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
