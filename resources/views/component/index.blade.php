<title>Component - Microsite Component Library</title>

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Component Management') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Create and manage components.") }}
                </p>
            </header>

            <!-- Success or Error Message -->
            <x-message/>

            <a href="{{ route('component.create') }}" 
                class="mt-4 inline-flex items-center px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700">
                Create New Component
            </a>

            <div class="overflow-x-auto mt-6">
                <table class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">No</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Version</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">Component</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Created At</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Updated At</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-900">
                        @foreach($components as $component)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 dark:text-white">{{ $component->Version->version }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-900 dark:text-white">{{ $component->Category->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-900 dark:text-white">{{ $component->component }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $component->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $component->updated_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div x-data="{ componentId: {{ $component->id }} }" class="flex items-center space-x-2">
                                            <button type="button" 
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700"
                                                x-on:click="$dispatch('open-modal', 'edit-component-' + componentId)">
                                                Edit
                                            </button>
                                            <button type="button" 
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-red-600 hover:bg-red-700"
                                                x-on:click="$dispatch('open-modal', 'delete-component-' + componentId)">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>