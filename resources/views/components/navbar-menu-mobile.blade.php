<div class="-mr-2 flex items-center sm:hidden relative gap-2" x-data="{ open: false }">
    <button @click="open = !open"
        class="inline-flex items-center justify-center p-2 rounded text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
            </path>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute top-9 right-0 mt-2 w-48 rounded-md bg-white p-4 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none;">
        <div role="none">
            @if (Route::has('login'))
                @auth
                    <div class="flex pb-2 gap-2 items-center">
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
                        <div class="flex flex-shrink-0">
                            <img id="avatar-preview" class="h-8 w-8 object-cover rounded-full" src="{{ $avatarUrl }}"
                                alt="User Avatar" />
                        </div>
                        <h1 class="text-sm font-semibold capitalize truncate text-gray-700 dark:text-gray-200">
                            {{ Auth::user()->name }}</h1>
                    </div>
                    <div class="my-2 border-b border-gray-200 dark:border-gray-800"></div>
                    <a href="{{ route('dashboard') }}"
                        class="block p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">Dashboard</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">Profile</a>
                    <a href="{{ route('settings.edit') }}"
                        class="block p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">Settings</a>
                    <div class="my-2 border-b border-gray-200 dark:border-gray-800"></div>
                    <a href="{{ route('docs.show') }}"
                        class="block p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">Docs</a>
                    <div class="flex items-center p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">
                        <span>Switch Theme</span>
                        <!-- Theme button and dropdown -->
                        <div class="relative ml-auto">
                            <div class="flex sm:hidden sm:items-center" x-data="{
                                open: false,
                                theme: localStorage.getItem('theme') || 'system',
                                updateTheme() {
                                    if (this.theme === 'system') {
                                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                                            document.documentElement.classList.add('dark');
                                        } else {
                                            document.documentElement.classList.remove('dark');
                                        }
                                    } else if (this.theme === 'dark') {
                                        document.documentElement.classList.add('dark');
                                    } else {
                                        document.documentElement.classList.remove('dark');
                                    }
                                    localStorage.setItem('theme', this.theme);
                                }
                            }" x-init="$watch('theme', () => updateTheme());
                            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => updateTheme());">

                                <!-- Theme button -->
                                <button @click="open = !open" type="button"
                                    class="flex items-center justify-center rounded-md text-primary dark:text-primary">
                                    <!-- Sun icon -->
                                    <svg x-show="theme === 'light'" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                                        </path>
                                    </svg>
                                    <!-- Moon icon -->
                                    <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                                        </path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                            d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
                                        </path>
                                    </svg>
                                    <!-- System icon -->
                                    <svg x-show="theme === 'system'" class="h-5 w-5" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"
                                            fill="none"></circle>
                                        <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
                                    </svg>
                                </button>

                                <!-- Theme dropdown -->
                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute top-6 right-0 mt-2 w-36 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
                                    style="display: none;">
                                    <button @click="theme = 'light'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'light' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                                            </path>
                                        </svg>
                                        Light
                                    </button>
                                    <button @click="theme = 'dark'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'dark' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                                            </path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
                                            </path>
                                        </svg>
                                        Dark
                                    </button>
                                    <button @click="theme = 'system'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'system' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9" stroke="currentColor"
                                                stroke-width="2" fill="none"></circle>
                                            <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
                                        </svg>
                                        System
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2 border-b border-gray-200 dark:border-gray-800"></div>
                    <form method="POST" action="{{ route('logout') }}" role="none" style="margin-bottom: 0">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                            role="menuitem" onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="flex p-2 font-semibold text-center text-sm text-gray-700 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition">
                        Sign In
                    </a>
                    <a href="{{ route('docs.show') }}"
                        class="block p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">Docs</a>
                    <div class="my-2 border-b border-gray-200 dark:border-gray-800"></div>
                    <div class="flex items-center p-2 text-sm rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                        role="menuitem">
                        <span>Switch Theme</span>
                        <!-- Theme button and dropdown -->
                        <div class="relative ml-auto">
                            <div class="flex sm:hidden sm:items-center" x-data="{
                                open: false,
                                theme: localStorage.getItem('theme') || 'system',
                                updateTheme() {
                                    if (this.theme === 'system') {
                                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                                            document.documentElement.classList.add('dark');
                                        } else {
                                            document.documentElement.classList.remove('dark');
                                        }
                                    } else if (this.theme === 'dark') {
                                        document.documentElement.classList.add('dark');
                                    } else {
                                        document.documentElement.classList.remove('dark');
                                    }
                                    localStorage.setItem('theme', this.theme);
                                }
                            }" x-init="$watch('theme', () => updateTheme());
                            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => updateTheme());">

                                <!-- Theme button -->
                                <button @click="open = !open" type="button"
                                    class="flex items-center justify-center rounded-md text-primary dark:text-primary">
                                    <!-- Sun icon -->
                                    <svg x-show="theme === 'light'" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                                        </path>
                                    </svg>
                                    <!-- Moon icon -->
                                    <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                                        </path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                            d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
                                        </path>
                                    </svg>
                                    <!-- System icon -->
                                    <svg x-show="theme === 'system'" class="h-5 w-5" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor"
                                            stroke-width="2" fill="none"></circle>
                                        <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
                                    </svg>
                                </button>

                                <!-- Theme dropdown -->
                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute top-6 right-0 mt-2 w-36 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-800 dark:ring-0"
                                    style="display: none;">
                                    <button @click="theme = 'light'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'light' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                                            </path>
                                        </svg>
                                        Light
                                    </button>
                                    <button @click="theme = 'dark'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'dark' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                                            </path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
                                            </path>
                                        </svg>
                                        Dark
                                    </button>
                                    <button @click="theme = 'system'; open = false"
                                        class="flex w-full items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                        :class="theme === 'system' ? 'text-primary dark:text-primary' :
                                            'text-gray-700 dark:text-gray-200'">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="9" stroke="currentColor"
                                                stroke-width="2" fill="none"></circle>
                                            <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
                                        </svg>
                                        System
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth
            @endif
        </div>
    </div>
</div>
