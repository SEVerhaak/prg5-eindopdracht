<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create test</title>
</head>
<body>
<x-nav-bar>

</x-nav-bar>
<h1>test</h1>
<form method="POST" action={{route('tests.store')}}>
    @csrf
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <button type="submit">Opslaan</button>
</form>
</body>
</html>