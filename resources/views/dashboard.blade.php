<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-3xl font-bold p-6 text-gray-900 dark:text-gray-100">
                    Welcome, {{ auth()->user()->name }}
                </div>
                <div class="mb-6 sm:px-6 ">
                    <a href="{{ route('profile.edit') }}" class="text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded shadow">
                        Edit Your Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
