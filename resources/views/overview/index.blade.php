@props(['albums' => $albums, 'genres' => $genres])

<x-standard-layout title="Personal Album Overview">
    <h1 class="text-3xl font-bold m-6">Album Overview</h1>

    <x-overview-list :albums="$albums" :genres="$genres">
        <!-- no content needed, idk wrm ik dit een component gemaakt heb -->
    </x-overview-list>
</x-standard-layout>
