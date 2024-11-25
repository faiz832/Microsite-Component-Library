<title>Dashboard - Microsite Component Library</title>

<x-app-layout>
    <div class="">
        <div class="p-6 rounded-md border border-gray-200 dark:border-gray-800">
            @role('admin')
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h1>
            @else
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 leading-tight">
                    {{ __('User Dashboard') }}
                </h1>
            @endrole
        </div>
    </div>
</x-app-layout>