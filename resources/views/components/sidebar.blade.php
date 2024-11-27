<aside class="hidden sm:flex flex-col w-64">
    <nav class="flex-1 py-8 space-y-4">
        <!-- Home Section -->
        <div>
            <!-- Search -->
            <div class="mb-4">
                <x-sidebar-search />
            </div>

            <div class="mb-2 pt-4 border-t border-gray-200 dark:border-gray-800">
                <h2 class="px-2 text-xs font-semibold text-gray-500 dark:text-gray-400">
                    Home
                </h2>
            </div>
            <div class="space-y-1">
                <a href="{{route('dashboard')}}" class="{{Route::is('dashboard') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <div class="{{Route::is('dashboard') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                @role('admin')
                    <a href="{{route('admin.users.index')}}" class="{{Route::is('admin.users.index') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                        <div class="{{Route::is('admin.users.index') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                        <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        User
                    </a>
                @endrole
            </div>
        </div>

        <!-- Data Section -->
        <div>
            <div class="mb-2 pt-4 border-t border-gray-200 dark:border-gray-800">
                <h2 class="px-2 text-xs font-semibold text-gray-500 dark:text-gray-400">
                    Data
                </h2>
            </div>
            <div class="space-y-1">
                <a href="#" class="flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Component
                </a>
                <a href="{{route('category.index')}}" class="{{Route::is('category.index') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <div class="{{Route::is('category.index') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Category
                </a>
                <a href="{{route('version.index')}}" class="{{Route::is('version.index') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <div class="{{Route::is('version.index') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    Version
                </a>
            </div>
        </div>

        <!-- Account Section -->
        <div>
            <div class="mb-2 pt-4 border-t border-gray-200 dark:border-gray-800">
                <h2 class="px-2 text-xs font-semibold text-gray-500 dark:text-gray-400">
                    Account
                </h2>
            </div>
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="{{Route::is('profile.edit') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <div class="{{Route::is('profile.edit') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('settings.edit') }}" class="{{Route::is('settings.edit') ? 'font-semibold dark:text-white' : ''}} relative flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <div class="{{Route::is('settings.edit') ? 'block' : 'hidden'}} absolute inset-y-0 -left-2 w-1 h-6 my-auto bg-purple-600 rounded-t-lg rounded-b-lg"></div>
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </div>
        </div>

        <!-- Logout Section -->
        <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
            <form method="POST" action="{{ route('logout') }}" role="none" style="margin-bottom: 0">
                @csrf
                <button type="submit" class="w-full flex items-center px-2 py-2 text-sm rounded-md text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="mr-3 h-5 w-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>