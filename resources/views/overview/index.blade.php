@props(['albums' => $albums, 'genres' => $genres, 'query' => $query])

<x-standard-layout title="Public Album Overview">
    <h1 class="text-3xl font-bold m-6">Public Album Overview</h1>
    <x-overview-search :genres="$genres" :query="$query">

    </x-overview-search>
    <x-overview-list :albums="$albums">
        <!-- no content needed, idk wrm ik dit een component gemaakt heb -->
    </x-overview-list>
</x-standard-layout>
