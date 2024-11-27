<nav x-data="{ open: false }" class="sticky top-0 z-40 w-full backdrop-blur flex-none bg-transparent border-b border-gray-200 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 sm:border-0 border-gray-200 dark:border-gray-800 {{Route::is('home') ? 'border-0' : 'border-b'}}">
            <div class="flex gap-4 items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-text-logo class="{{Route::is('docs') ? 'hidden' : 'block'}} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                        <x-application-text-logo class="{{Route::is('docs') ? 'hidden sm:block' : 'hidden'}} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                        <x-application-logo class="{{Route::is('docs') ? 'block sm:hidden' : 'hidden'}} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                    </a>
                </div>

                <x-version-dropdown/>
            </div>

            <div class="flex h-max ml-auto">
                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center">
                    <a href="{{ route('docs') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition">Docs</a>
                </div>
                
                <div class="flex items-center border-l border-gray-200 ml-6 pl-4 gap-2 dark:border-gray-800">
                    <!-- Theme button and dropdown -->
                    <div class="relative">
                        <x-theme-toggle/>
                    </div>

                    <!-- Login button -->
                    @if (Route::has('login'))
                        <nav class="relative">
                            @auth
                                <!-- Dropdown Button -->
                                <div class="hidden sm:flex relative gap-2 cursor-pointer" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false" class="flex items-center">
                                        <div class="avatar">
                                            @php
                                                $avatarUrl = asset('assets/images/default-avatar.png'); // Default avatar URL
    
                                                if (Auth::user()->avatar) {
                                                    if (Str::startsWith(Auth::user()->avatar, 'https://')) {
                                                        $avatarUrl = Auth::user()->avatar;
                                                    } elseif (Str::startsWith(Auth::user()->avatar, 'avatars/')) {
                                                        $avatarUrl = Storage::url(Auth::user()->avatar);
                                                    }
                                                }
                                            @endphp
    
                                            <img id="avatar-preview" class="h-[32px] w-[32px] object-cover rounded-full"
                                                src="{{ $avatarUrl }}" alt="User Avatar" />
                                        </div>
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute top-9 right-0 mt-2 w-48 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                        style="display: none;">
                                        <div role="none">
                                            <a href="{{ route('dashboard') }}"
                                                class="block px-4 py-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                                role="menuitem">Dashboard</a>
                                            <a href="{{ route('profile.edit') }}"
                                                class="block px-4 py-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                                role="menuitem">Profile</a>
                                            <a href="{{ route('settings.edit') }}"
                                                class="block px-4 py-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                                role="menuitem">Settings</a>
                                            <form method="POST" action="{{ route('logout') }}" role="none" style="margin-bottom: 0">
                                                @csrf
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                                    role="menuitem"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Log Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}"
                                    class="hidden sm:flex font-semibold text-center text-sm rounded-md px-3 py-2 text-white dark:text-white bg-gray-900 dark:bg-purple-600 hover:bg-gray-700 dark:hover:bg-purple-500 transition">
                                    Sign In
                                </a>
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>

            <!-- Search Icon -->
            <x-navbar-search />

            <!-- Three Dots -->
            <x-navbar-menu-mobile/>
        </div>
    </div>

    <!-- Mobile menu button -->
    <div class="mx-auto p-4 items-center sm:hidden {{Route::is('home') ? 'hidden' : 'flex'}}">

        <!-- Hamburger Menu -->
        <div class="{{Route::is('dashboard') || Route::is('admin.users.index') || Route::is('profile.edit') || Route::is('settings.edit') ? 'flex' : 'hidden'}}">
            <x-sidebar-dashboard-mobile/>
        </div>
        
        <div class="{{Route::is('docs') ? 'flex' : 'hidden'}}">
            <x-sidebar-docs-mobile/>
        </div>

        <!-- Breadcrumb -->
        <x-breadcrumb />
    </div>
</nav>