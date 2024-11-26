<title>User Management - Microsite Component Library</title>

<x-app-layout>
    <div class="">
        <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('User Management') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update the user's role or status activation.") }}
                </p>
            </header>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto mt-6">
                <table class="min-w-full">
                    <thead class="border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-900 dark:text-white tracking-wider">Email</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Role</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-sm font-medium text-gray-900 dark:text-white tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-900">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500 dark:text-white">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-500 dark:text-white">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.users.update.role', $user->id) }}" method="POST" class="flex items-center justify-center space-x-2" style="margin-bottom: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->isUserActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $user->isUserActive() ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        @foreach($activations as $activation)
                                            <form action="{{ route('admin.users.toggle.activation', $user->id) }}" method="POST" style="margin-bottom: 0;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="activation_id" value="{{ $activation->id }}">
                                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded 
                                                    {{ $user->activations->contains($activation->id) 
                                                        ? 'bg-red-600 hover:bg-red-700' 
                                                        : 'bg-green-600 hover:bg-green-700' }} 
                                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    {{ $user->activations->contains($activation->id) ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        <script>
            // Konfirmasi sebelum mengubah role atau status aktivasi
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const isRoleForm = this.querySelector('select[name="role"]');
                        const isActivationForm = this.querySelector('input[name="activation_id"]');
                        
                        if (isRoleForm) {
                            const userName = this.closest('tr').querySelector('.text-gray-900').textContent.trim();
                            const newRole = isRoleForm.options[isRoleForm.selectedIndex].text;
                            
                            if (!confirm(`Are you sure you want to change ${userName}'s role to ${newRole}?`)) {
                                e.preventDefault();
                            }
                        } else if (isActivationForm) {
                            const userName = this.closest('tr').querySelector('.text-gray-900').textContent.trim();
                            const currentStatus = this.querySelector('button').textContent.trim();
                            
                            if (!confirm(`Are you sure you want to ${currentStatus.toLowerCase()} ${userName}?`)) {
                                e.preventDefault();
                            }
                        }
                    });
                });
            });
        </script>
    </div>
</x-app-layout>