<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Display User Role --}}
                    <div class="mb-4">
                        @php
                            $role = auth()->user()->role; // Assuming you have a role column in your users table
                            $roleName = '';

                            switch ($role) {
                                case 1:
                                    $roleName = 'Admin';
                                    break;
                                case 2:
                                    $roleName = 'Moderator';
                                    break;
                                case 3:
                                    $roleName = 'Verified User';
                                    break;
                                case 4:
                                    $roleName = 'Unverified User';
                                    break;
                                default:
                                    $roleName = 'Unknown Role';
                            }
                        @endphp

                        <p class="text-2xl font-bold text-white">Role: {{ $roleName }}</p>
                    </div>

                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
