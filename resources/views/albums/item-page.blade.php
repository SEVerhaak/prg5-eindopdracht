@props(['albums' => $albums, 'genres' => $genres])

<x-standard-layout title="Personal Album Overview">
    <h1 class="text-3xl font-bold m-6">Your Albums</h1>

    <x-secret-list :albums="$albums" :genres="$genres">
        <!-- no content needed, idk wrm ik dit een component gemaakt heb -->
    </x-secret-list>
</x-standard-layout>
