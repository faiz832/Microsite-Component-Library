<div x-data="{ isOpen: false }" @keydown.window.escape="isOpen = false" @keydown.window.ctrl.k.prevent="isOpen = true">
    <button
        type="button"
        @click="isOpen = true"
        class="flex sm:hidden ml-auto p-2 text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="M21 21l-4.35-4.35"></path>
        </svg>
    </button>

    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="sm:hidden absolute top-0 right-0 h-screen w-full z-50 p-4 sm:p-6 md:p-20"
        role="dialog"
        aria-modal="true"
        style="display: none;">
        <div
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute top-0 right-0 h-screen w-full bg-gray-500/70 transition-opacity dark:bg-gray-900/70 backdrop-blur-sm"
            @click="isOpen = false"
            aria-hidden="true">
        </div>

        <div
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all dark:bg-gray-800 dark:divide-gray-700 dark:ring-white/10">
            <div class="relative">
                <svg class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400 dark:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                <input
                    type="text" autofocus
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm dark:text-white dark:placeholder:text-gray-500"
                    placeholder="Search..."
                    x-ref="searchInput"
                    @keydown.escape.window="isOpen = false"
                    x-init="$nextTick(() => $refs.searchInput.focus())">
                <button
                    @click="isOpen = false"
                    class="absolute top-2 right-3 p-1 text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <ul class="min-h-40 max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800 dark:text-gray-200">
                <!-- Add your search results here -->
                <li class="cursor-default select-none px-4 py-2">Search result 1</li>
                <li class="cursor-default select-none px-4 py-2">Search result 2</li>
                <!-- ... -->
            </ul>

            <div class="flex flex-wrap items-center bg-gray-50 py-2.5 px-4 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                Press <kbd class="mx-1 p-1 flex items-center justify-center rounded-md border bg-white font-semibold dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Esc</kbd> to close
            </div>
        </div>
    </div>
</div>

