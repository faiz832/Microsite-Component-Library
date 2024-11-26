<title>Settings - Microsite Component Library</title>

<x-app-layout>
    <!-- Main Content -->
    <div class="">
        <div class="space-y-6">
            <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 rounded-md border border-gray-200 dark:border-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
