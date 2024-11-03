<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/app.css').time() }}" rel="stylesheet">
    <title>{{ $title ?? 'Album Website' }}</title>
</head>
<x-nav-bar>

</x-nav-bar>
<body >
{{$slot}}
</body>
</html>
