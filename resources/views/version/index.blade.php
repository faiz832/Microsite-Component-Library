<title>Version - Microsite Component Library</title>

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Version Management') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Create and manage versions.') }}
                </p>
            </header>

            <!-- Success or Error Message -->
            <x-message />

            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-version')"
                class="mt-4 inline-flex items-center px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700 transition">
                Create New Version
            </button>

            <div class="overflow-x-auto mt-6">
                <table id="dataTable" class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Version</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Created At</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Updated At</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-900">
                        @foreach ($versions as $version)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500">
                                    {{ $loop->iteration }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $version->version }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $version->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    {{ $version->updated_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div x-data="{ versionId: {{ $version->id }} }" class="flex items-center space-x-2">
                                            <button type="button"
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700"
                                                x-on:click="$dispatch('open-modal', 'edit-version-' + versionId)">
                                                Edit
                                            </button>
                                            <button type="button"
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-red-600 hover:bg-red-700"
                                                x-on:click="$dispatch('open-modal', 'delete-version-' + versionId)">
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

        <!-- Create Version Modal -->
        <x-modal name="create-version" focusable>
            <form method="POST" action="{{ route('version.store') }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Create New Version') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Please insert a new version.') }}
                </p>

                <div class="mt-4 max-w-sm">
                    <x-input-label for="version" value="{{ __('Insert Version') }}" />

                    <x-text-input id="version" name="version" type="text" class="mt-1 block w-full"
                        placeholder="{{ __('Version') }}" required />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-confirm-button class="ml-3">
                        {{ __('Create') }}
                    </x-confirm-button>
                </div>
            </form>
        </x-modal>

        @foreach ($versions as $version)
            <!-- Edit Version Modals -->
            <x-modal :name="'edit-version-' . $version->id" focusable>
                <form method="POST" action="{{ route('version.update', $version->id) }}" class="p-6">
                    @csrf
                    @method('PATCH')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit Version') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Please insert a new version.') }}
                    </p>

                    <div class="mt-4 max-w-sm">
                        <x-input-label for="version" value="{{ __('Insert Version') }}" />

                        <x-text-input id="version" name="version" type="text" class="mt-1 block w-full"
                            :value="$version->version" required />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-confirm-button class="ml-3">
                            {{ __('Update') }}
                        </x-confirm-button>
                    </div>
                </form>
            </x-modal>

            <!-- Delete Version Modals -->
            <x-modal :name="'delete-version-' . $version->id" focusable>
                <form method="POST" action="{{ route('version.destroy', $version->id) }}" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Delete Version') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Are you sure you want to delete this version? This action cannot be undone.') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Delete Version') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        @endforeach
    </div>
</x-app-layout>
