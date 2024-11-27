@props(['versions' => [
    ['value' => 'v24', 'label' => 'v24'],
    ['value' => 'v23', 'label' => 'v23'],
    ]])

<div x-data="{ 
    open: false, 
    selectedVersion: '{{ $versions[0]['value'] }}',
    versions: {{ json_encode($versions) }},
    toggle() { this.open = !this.open },
    close() { this.open = false }}" class="relative text-left {{Route::is('docs') ? 'inline-block' : 'hidden'}}">
    <div>
        <button @click="toggle()" type="button" class="text-xs leading-5 font-semibold text-gray-500 dark:text-gray-300 bg-gray-400/10 dark:bg-gray-900 rounded-full py-1 px-3 flex items-center space-x-2 hover:bg-gray-400/20 dark:hover:bg-gray-700" id="version-selector" aria-haspopup="true" x-bind:aria-expanded="open">
            <span x-text="selectedVersion"></span>
                <svg class="-mr-1 ml-2 mt-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
        </button>
    </div>

    <div x-show="open" @click.away="close()" style="display: none;" 
        x-transition:enter="transition ease-out duration-100" 
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100" 
        x-transition:leave-end="transform opacity-0 scale-95" 
        class="origin-top-left absolute left-0 mt-2 w-24 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0" role="menu" aria-orientation="vertical" aria-labelledby="version-selector">
        <div role="none">
            <template x-for="version in versions" :key="version.value">
                <button @click="selectedVersion = version.value; close()" class="flex justify-between w-full p-1 text-sm leading-5 font-semibold rounded-md text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600/30" role="menuitem">
                    <span x-text="version.label" :class="selectedVersion === version.value ? 'text-primary dark:text-primary' : 'text-gray-700 dark:text-gray-200'"></span>
                    <svg x-show="selectedVersion === version.value" class="h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </template>
        </div>
    </div>
</div>