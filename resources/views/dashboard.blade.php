<title>Dashboard - Microsite Component Library</title>

<x-app-layout>
    <div class="space-y-6">
        <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
            @role('admin')
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Welcome Back Developer!') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('You are logged in as an admin.') }}
                </p>
            @else
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Welcome Back Developer!') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('You are logged in as a user.') }}
                </p>
            @endrole
        </div>

        <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Data Summary
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                You can see all the total data here.
            </p>

            @role('admin')
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Users
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $users->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Components
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $components->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Categories
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $categories->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Versions
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $versions->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('user')
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Components
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $components->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Categories
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $categories->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
                        <div class="flex gap-4">
                            <div class="rounded-md bg-gray-100 dark:bg-gray-800 p-4">
                                <svg class="h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                            </div>
                            <div class="">
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    Versions
                                </h2>
                                <h2 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $versions->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </div>
</x-app-layout>
