<div class="hidden sm:flex sm:items-center" x-data="{
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
        class="flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600/30">
        <!-- Sun icon -->
        <svg x-show="theme === 'light'" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
            </path>
        </svg>
        <!-- Moon icon -->
        <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
            </path>
            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
            </path>
        </svg>
        <!-- System icon -->
        <svg x-show="theme === 'system'" class="h-5 w-5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"></circle>
            <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
        </svg>
    </button>

    <!-- Theme dropdown -->
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute top-9 right-0 mt-2 w-36 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
        style="display: none;">
        <button @click="theme = 'light'; open = false"
            class="flex w-full font-semibold items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
            :class="theme === 'light' ? 'text-primary dark:text-primary' : 'text-gray-700 dark:text-gray-200'">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z">
                </path>
            </svg>
            Light
        </button>
        <button @click="theme = 'dark'; open = false"
            class="flex w-full font-semibold items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
            :class="theme === 'dark' ? 'text-primary dark:text-primary' : 'text-gray-700 dark:text-gray-200'">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z">
                </path>
                <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                    d="M19.5 0.5a1 1 0 0 1 1 1 2 2 0 0 0 2 2 1 1 0 1 1 0 2 2 2 0 0 0-2 2 1 1 0 1 1-2 0 2 2 0 0 0-2-2 1 1 0 1 1 0-2 2 2 0 0 0 2-2 1 1 0 0 1 1-1Z">
                </path>
            </svg>
            Dark
        </button>
        <button @click="theme = 'system'; open = false"
            class="flex w-full font-semibold items-center gap-2 rounded-md p-1 hover:bg-gray-100 dark:hover:bg-gray-600/30"
            :class="theme === 'system' ? 'text-primary dark:text-primary' : 'text-gray-700 dark:text-gray-200'">
            <svg class="h-5 w-5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none">
                </circle>
                <path d="M12 3a9 9 0 0 1 0 18" fill="currentColor"></path>
            </svg>
            System
        </button>
    </div>
</div>
