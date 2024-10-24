@props(['albums' => $albums, 'genres' => $genres])

<x-standard-layout title="Personal Album Overview">
    <h1>Your album overview!</h1>
    <x-secret-list :albums="$albums" :genres="$genres">

    </x-secret-list>
</x-standard-layout>
