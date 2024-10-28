<x-standard-layout>
    <style>
        /* Prevent scrolling */
        html, body {
            height: 100%;
            overflow: hidden; /* Prevent scrolling */
        }
    </style>
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md mx-auto">
            <h1 class="text-2xl font-bold text-red-600 mb-4">Access Denied</h1>
            <p class="text-gray-700 mb-6">
                For privacy reasons, you need to have at least 5 albums posted before you can search for users.
            </p>
            <p class="text-gray-600 mb-4">
                Please consider adding more albums to your profile. Once you have reached the required number, you will be able to access the user search feature.
            </p>
            <a href="{{ route('albums.create') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                Add Albums
            </a>
            <div class="mt-6">
                <a href="{{ route('welcome') }}" class="text-blue-500 hover:underline">Go back to home</a>
            </div>
        </div>
    </div>
</x-standard-layout>
