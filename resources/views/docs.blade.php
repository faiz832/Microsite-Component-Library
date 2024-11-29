<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Documentation - Microsite Component Library</title>

    <!-- Prevent Flash of Incorrect Theme -->
    <script>
        // Immediately invoked function to set the theme before page load
        (function() {
            let theme = localStorage.getItem("theme") || "system";

            if (theme === "dark" || (theme === "system" && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased h-full">
    <div class="min-h-screen bg-white dark:bg-bgDark">
        <!-- Navbar -->
        <nav id="navbar" x-data="{ dropdownOpen: false }" :class="{ 'z-50': dropdownOpen, 'z-20': !dropdownOpen }"
            class="sticky top-0 w-full flex-none border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-bgDark">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex items-center h-16 lg:border-0 border-gray-200 dark:border-gray-800 {{ Route::is('home') ? 'border-0' : 'border-b' }}">
                    <div class="flex gap-4 items-center">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-text-logo
                                    class="{{ Route::is('docs') ? 'hidden md:block' : 'hidden' }} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                                <x-application-logo
                                    class="{{ Route::is('docs') ? 'block md:hidden' : 'hidden' }} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                            </a>
                        </div>

                        @props(['versions' => [['value' => 'v24', 'label' => 'v24'], ['value' => 'v23', 'label' => 'v23']]])

                        <div x-data="{
                            open: false,
                            selectedVersion: '{{ $versions[0]['value'] }}',
                            versions: {{ json_encode($versions) }},
                            toggle() {
                                this.open = !this.open;
                                this.$dispatch('dropdown-toggled', this.open);
                            },
                            close() {
                                this.open = false;
                                this.$dispatch('dropdown-toggled', false);
                            }
                        }" @dropdown-toggled.window="dropdownOpen = $event.detail"
                            class="relative text-left {{ Route::is('docs') ? 'inline-block' : 'hidden' }}">
                            <div>
                                <button id="version-button" @click="toggle()" type="button"
                                    class="text-xs leading-5 font-semibold text-gray-500 dark:text-gray-300 bg-gray-400/10 dark:bg-gray-900 rounded-full py-1 px-3 flex items-center space-x-2 hover:bg-gray-400/20 dark:hover:bg-gray-700"
                                    id="version-selector" aria-haspopup="true" x-bind:aria-expanded="open">
                                    <span x-text="selectedVersion"></span>
                                    <svg class="-mr-1 ml-2 mt-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
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
                                class="origin-top-left absolute left-0 mt-2 w-24 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
                                role="menu" aria-orientation="vertical" aria-labelledby="version-selector">
                                <div role="none">
                                    <template x-for="version in versions" :key="version.value">
                                        <button @click="selectedVersion = version.value; close()"
                                            class="flex justify-between w-full p-1 text-sm leading-5 font-semibold rounded-md text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600/30"
                                            role="menuitem">
                                            <span x-text="version.label"
                                                :class="selectedVersion === version.value ? 'text-primary dark:text-primary' :
                                                    'text-gray-700 dark:text-gray-200'"></span>
                                            <svg x-show="selectedVersion === version.value" class="h-5 w-5 text-primary"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex h-max ml-auto">
                        <!-- Navigation Links -->
                        <div class="hidden sm:flex items-center">
                            <a href="{{ route('docs') }}"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition">Docs</a>
                        </div>

                        <div class="flex items-center border-l border-gray-200 ml-6 pl-4 gap-2 dark:border-gray-800">
                            <!-- Theme button and dropdown -->
                            <div class="relative">
                                <x-theme-toggle />
                            </div>

                            <!-- Login button -->
                            @if (Route::has('login'))
                                <nav class="relative">
                                    @auth
                                        <!-- Dropdown Button -->
                                        <div class="hidden sm:flex relative gap-2 cursor-pointer" x-data="{ open: false }">
                                            <button @click="open = !open" @click.away="open = false"
                                                class="flex items-center">
                                                <div class="avatar">
                                                    @php
                                                        $avatarUrl = asset('assets/images/default-avatar.png'); // Default avatar URL

                                                        if (Auth::user()->avatar) {
                                                            if (Str::startsWith(Auth::user()->avatar, 'https://')) {
                                                                $avatarUrl = Auth::user()->avatar;
                                                            } elseif (
                                                                Str::startsWith(Auth::user()->avatar, 'avatars/')
                                                            ) {
                                                                $avatarUrl = Storage::url(Auth::user()->avatar);
                                                            }
                                                        }
                                                    @endphp

                                                    <img id="avatar-preview"
                                                        class="h-[32px] w-[32px] object-cover rounded-full"
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
                                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                                tabindex="-1" style="display: none;">
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
                                                    <form method="POST" action="{{ route('logout') }}" role="none"
                                                        style="margin-bottom: 0">
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
                    <x-navbar-menu-mobile />
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="mx-auto p-4 sm:px-6 items-center lg:hidden {{ Route::is('home') ? 'hidden' : 'flex' }}">

                <!-- Docs Sidebar Menu -->
                <div class="w-6 h-6 {{ Route::is('docs') ? 'flex' : 'hidden' }}">
                    <x-sidebar-docs-mobile />
                </div>

                <!-- Breadcrumb -->
                <x-breadcrumb />
            </div>
        </nav>

        <!-- Page Content -->
        <div class="min-h-[calc(100vh-114px)]">
            <div class="overflow-hidden">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Sidebar -->
                    <div
                        class="hidden lg:block fixed z-40 inset-0 top-[4.05rem] left-0 right-auto w-80 pb-10 pl-8 pr-6 overflow-y-auto">
                        <x-sidebar-docs />
                    </div>

                    <!-- Content -->
                    <div class="min-h-[calc(100vh-114px)]">
                        <main class="lg:pl-80">
                            <div class="w-full py-6 sm:py-8">
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                                <header id="header" class="mb-10 md:flex md:items-start">
                                    <div class="flex-auto max-w-4xl">
                                        <p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">
                                            Installation</p>
                                        <h1
                                            class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Get started with Tailwind CSS</h1>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works
                                            by
                                            scanning all of your HTML files, JavaScript components, and any other
                                            templates for class names, generating the corresponding styles and then
                                            writing them to a static CSS file.</p>
                                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible,
                                            and reliable — with zero-runtime.</p>
                                    </div>
                                </header>
                            </div>

                            <!-- Footer -->
                            <footer class="pb-8 border-t border-gray-200 dark:border-gray-800">
                                <div
                                    class="h-14 sm:h-12 flex flex-col-reverse sm:flex-row gap-2 sm:justify-between justify-center items-center">
                                    <div class="text-xs text-gray-900 dark:text-gray-200">
                                        © 2024 Detikcom Frontend Designer Team
                                    </div>
                                    <div class="flex gap-4">
                                        <a href="#"
                                            class="text-xs text-gray-700 dark:text-gray-200 hover:underline">
                                            Privacy Policy
                                        </a>
                                        <a href="#"
                                            class="text-xs text-gray-700 dark:text-gray-200 hover:underline">
                                            Terms of Service
                                        </a>
                                    </div>
                                </div>
                            </footer>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
