<x-standard-layout title="Home">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center max-w-2xl mx-auto px-6 py-12 bg-white shadow-lg rounded-lg">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Vinyl Vault</h1>
            <p class="text-gray-600 mb-8">
                Vinyl Vault is a place for vinyl enthusiasts to track, share, and showcase their album collections.
                Easily upload albums,
                keep your records organized, and explore the collections of others in our community!
            </p>

            <div class="text-left mb-6 space-y-4">
                <h2 class="text-2xl font-semibold text-gray-700">What You Can Do:</h2>
                <ul class="list-disc list-inside text-gray-600">
                    <li><span class="font-semibold">Upload your albums:</span> Add albums to your personal collection to
                        see how large it’s grown!
                    </li>
                    <li><span class="font-semibold">Edit and manage:</span> Update album details and choose whether to
                        make them public or private.
                    </li>
                    <li><span class="font-semibold">Explore other collections:</span> Once you’ve posted 5 albums, you
                        can view and discover the collections of other users!
                    </li>
                </ul>
            </div>

            <div class="flex justify-center space-x-4">
                @if (auth()->check())
                    <a href="{{ route('albums.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow-lg">
                        Add an Album
                    </a>
                @endif
                @if (!auth()->check())

                    <a href="{{ route('register') }}"
                       class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow-lg">
                        Join the Community
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-standard-layout>
