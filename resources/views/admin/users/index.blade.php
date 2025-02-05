<title>User - Microsite Component Library</title>

<x-app-layout>
    <div>
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('User Management') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update the user's role or status activation.") }}
                </p>
            </header>

            @if (session('success') || $errors->any())
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mt-4">
                    @if (session('success'))
                        <div class="flex my-4">
                            <span
                                class="text-sm text-green-600 dark:text-green-400 space-y-1">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="flex my-4">
                            @foreach ($errors->all() as $error)
                                <span
                                    class="text-sm text-red-600 dark:text-red-400 space-y-1">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <div class="overflow-x-auto mt-6">
                <table id="dataTable" class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-900">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500">
                                    {{ $loop->iteration }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium capitalize text-gray-900 dark:text-white">
                                    {{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500">
                                    {{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @foreach ($roles as $role)
                                        <div class="flex justify-center items-center">
                                            <span
                                                class="inline-flex text-sm font-medium capitalize text-gray-900 dark:text-white">
                                                {{ $user->hasRole($role->name) ? $role->name : '' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <span
                                            class="inline-flex text-xs font-semibold leading-5 rounded-full {{ $user->isUserActive() ? 'text-gray-500' : 'text-gray-500' }}">
                                            {{ $user->isUserActive() ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div x-data="{ userId: {{ $user->id }} }" class="flex items-center justify-center space-x-2">
                                            <button type="button"
                                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs text-white font-medium rounded-md bg-gray-900 hover:bg-gray-700 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none"
                                                x-on:click="$dispatch('open-modal', 'confirm-role-update-' + userId)">
                                                Edit
                                            </button>
                                        </div>
                                        @foreach ($activations as $activation)
                                            <div x-data="{ userId: {{ $user->id }}, activationId: {{ $activation->id }} }" style="margin-bottom: 0;">
                                                <button type="button"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs text-white font-medium rounded-md 
                                                    {{ $user->activations->contains($activation->id)
                                                        ? 'bg-red-600 hover:bg-red-700'
                                                        : 'bg-green-600 hover:bg-green-700' }} 
                                                    focus:outline-none flex items-center"
                                                    x-on:click="$dispatch('open-modal', 'confirm-activation-toggle-' + userId + '-' + activationId)">
                                                    {{ $user->activations->contains($activation->id) ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($users as $user)
            <x-modal :name="'confirm-role-update-' . $user->id" focusable>
                <form method="POST" action="{{ route('admin.users.update.role', $user->id) }}" class="p-6">
                    @csrf
                    @method('PATCH')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Confirm Role Update') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Are you sure you want to update the role for :name?', ['name' => $user->name]) }}
                    </p>

                    <!-- Role Selection -->
                    <div class="mt-4 max-w-sm">
                        <x-input-label for="role" value="{{ __('Choose Role') }}" />
                        <select name="role"
                            class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-confirm-button class="ml-3" type="submit">
                            {{ __('Update') }}
                        </x-confirm-button>
                    </div>
                </form>
            </x-modal>

            @foreach ($activations as $activation)
                <x-modal :name="'confirm-activation-toggle-' . $user->id . '-' . $activation->id">
                    <form method="POST" action="{{ route('admin.users.toggle.activation', $user->id) }}"
                        class="p-6">
                        @csrf
                        @method('PATCH')
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Confirm Activation Status Change') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Are you sure you want to :action :name?', [
                                'action' => $user->activations->contains($activation->id) ? 'deactivate' : 'activate',
                                'name' => $user->name,
                            ]) }}
                        </p>
                        <div class="mt-6">
                            <input type="hidden" name="activation_id" value="{{ $activation->id }}">
                        </div>
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-button
                                class="ml-3 {{ $user->activations->contains($activation->id) ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}"
                                type="submit">
                                {{ $user->activations->contains($activation->id) ? __('Deactivate') : __('Activate') }}
                            </x-button>
                        </div>
                    </form>
                </x-modal>
            @endforeach
        @endforeach
    </div>
</x-app-layout>
