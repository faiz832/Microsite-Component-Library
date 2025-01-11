<div x-data="searchComponent()" @keydown.window.escape="isOpen = false"
    @keydown.window.ctrl.k.prevent="isOpen = true, openSearch()">
    <button type="button" @click="openSearch"
        class="hidden sm:flex items-center w-full sm:w-72 text-left space-x-3 px-4 h-12 bg-white ring-1 ring-gray-900/10 hover:ring-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 shadow-sm rounded-md text-gray-400 dark:bg-gray-800 dark:ring-0 dark:text-gray-300 dark:highlight-white/5 dark:hover:bg-gray-700">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="M21 21l-4.35-4.35"></path>
        </svg>
        <span class="flex-auto">Search components...</span>
        <kbd class="font-sans font-semibold dark:text-gray-500">
            <abbr title="Control" class="no-underline dark:text-gray-500">Ctrl </abbr> K
        </kbd>
    </button>

    <div x-show="isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="hidden sm:block fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20 backdrop-blur-sm" role="dialog"
        aria-modal="true" style="display: none;">
        <div x-show="isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500/70 transition-opacity dark:bg-gray-900/70" @click="isOpen = false"
            aria-hidden="true">
        </div>

        <div x-show="isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="mx-auto max-w-3xl transform divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all dark:bg-gray-800 dark:divide-gray-700 dark:ring-white/10">
            <div class="relative">
                <svg class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400 dark:text-gray-500"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd" />
                </svg>
                <input type="text"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm dark:text-white dark:placeholder:text-gray-500"
                    placeholder="Search..." x-ref="searchInput" @input.debounce.300ms="search"
                    @keydown.escape.window="isOpen = false">
                <button @click="isOpen = false"
                    class="absolute top-2 right-3 p-1 text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Loading indicator -->
            <div x-show="isSearching" class="h-40 flex items-center justify-center">
                <svg class="animate-spin h-8 w-8 mx-auto text-gray-500" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <!-- No results message -->
            <div x-show="!isSearching && query.length >= 2 && Object.keys(searchResults).length === 0"
                class="h-40 flex items-center justify-center text-gray-500">
                No results found
            </div>

            <ul x-show="!isSearching && Object.keys(searchResults).length > 0"
                class="max-h-96 scroll-py-2 overflow-y-auto pb-6 text-sm text-gray-800 dark:text-gray-200">
                <template x-for="(versionGroup, version) in searchResults" :key="version">
                    <li class="mx-6">
                        <h3 class="sticky top-0 z-10 pt-6 pb-2 text-base font-semibold bg-white dark:bg-gray-800"
                            x-text="'Version ' + version"></h3>
                        <template x-for="(categoryGroup, category) in versionGroup" :key="category">
                            <div class="mb-4">
                                <h4 class="font-medium" x-text="category"></h4>
                                <ul class="space-y-2">
                                    <template x-for="component in categoryGroup" :key="component.id">
                                        <li>
                                            <a :href="'/docs/' + version + '/' + category + '/' + component.component"
                                                class="block px-4 py-3 bg-gray-50 dark:bg-gray-700 hover:text-white hover:bg-purple-500 hover:dark:bg-purple-500 rounded-md transition"
                                                x-text="component.component"></a>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                    </li>
                </template>
            </ul>

            <div
                class="flex flex-wrap items-center bg-gray-50 py-2.5 px-4 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                Press <kbd
                    class="mx-1 p-1 flex items-center justify-center rounded-md border bg-white font-semibold dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Esc</kbd>
                to close
            </div>
        </div>
    </div>
</div>

<script>
    function searchComponent() {
        return {
            isOpen: false,
            searchResults: {},
            isSearching: false,
            query: '',
            search: function() {
                this.query = this.$refs.searchInput.value;
                if (this.query.length < 2) {
                    this.searchResults = {};
                    return;
                }

                this.isSearching = true;
                fetch('{{ route('search') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            query: this.query
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.searchResults = data;
                        this.isSearching = false;
                    })
                    .catch(() => {
                        this.isSearching = false;
                    });
            },
            openSearch: function() {
                this.isOpen = true;
                this.$nextTick(() => {
                    this.$refs.searchInput.focus();
                });
            }
        }
    }
</script>
