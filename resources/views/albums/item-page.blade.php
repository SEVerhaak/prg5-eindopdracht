@props(['albums' => $albums, 'genres' => $genres])

<x-standard-layout title="Personal Album Overview">
    <h1 class="text-3xl font-bold m-6">Your Albums</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <x-secret-list :albums="$albums" :genres="$genres">
        <!-- no content needed, idk wrm ik dit een component gemaakt heb -->
    </x-secret-list>
</x-standard-layout>
