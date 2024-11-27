<title>Category - Microsite Component Library</title>

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Category Management') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Create and manage categories.") }}
                </p>
            </header>

            <!-- Success or Error Message -->
            <x-message/>

            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')" 
                class="mt-4 inline-flex items-center px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700">
                Create New category
            </button>

            <div class="overflow-x-auto mt-6">
                <table class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">No</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Version</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">Category</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Created At</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Updated At</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-900">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 dark:text-white">{{ $category->Version->version }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-900 dark:text-white">{{ $category->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $category->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">{{ $category->updated_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div x-data="{ categoryId: {{ $category->id }} }" class="flex items-center space-x-2">
                                            <button type="button" 
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700"
                                                x-on:click="$dispatch('open-modal', 'edit-category-' + categoryId)">
                                                Edit
                                            </button>
                                            <button type="button" 
                                                class="px-2.5 py-1.5 text-xs text-white rounded-md bg-red-600 hover:bg-red-700"
                                                x-on:click="$dispatch('open-modal', 'delete-category-' + categoryId)">
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

        <!-- Create category Modal -->
        <x-modal name="create-category" focusable>
            <form method="POST" action="{{ route('category.store') }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Create New category') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Please insert a new category.") }}
                </p>

                <div class="mt-4 max-w-sm">
                    <x-input-label for="version_id" value="{{ __('Insert Version') }}"/>
                    <select name="version_id" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                        @foreach($versions as $version)
                            <option value="{{ $version->id }}">
                                {{ ucfirst($version->version) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 max-w-sm">
                    <x-input-label for="category" value="{{ __('Insert Category') }}"/>

                    <x-text-input
                        id="category"
                        name="category"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="{{ __('category') }}"
                        required
                    />
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

        @foreach($categories as $category)
            <!-- Edit category Modals -->
            <x-modal :name="'edit-category-' . $category->id" focusable>
                <form method="POST" action="{{ route('category.update', $category->id) }}" class="p-6">
                    @csrf
                    @method('PATCH')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Edit category') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Please insert a new category.") }}
                    </p>

                    <div class="mt-4 max-w-sm">
                        <x-input-label for="version_id" value="{{ __('Input Version') }}"/>

                        <select name="version_id" class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                            @foreach($versions as $version)
                                <option value="{{ $version->id }}"
                                    {{ $version->id == $category->version_id ? 'selected' : '' }}>
                                    {{ $version->version }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 max-w-sm">
                        <x-input-label for="category" value="{{ __('Input Category') }}"/>

                        <x-text-input
                            id="category"
                            name="category"
                            type="text"
                            class="mt-1 block w-full"
                            :value="$category->category"
                            required
                        />
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

            <!-- Delete category Modals -->
            <x-modal :name="'delete-category-' . $category->id" focusable>
                <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="p-6">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Delete category') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Are you sure you want to delete this category? This action cannot be undone.") }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Delete category') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        @endforeach
    </div>
</x-app-layout>