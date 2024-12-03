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

    <style>
        .tooltip::before {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 8px;
            height: 8px;
            background-color: #1f2937;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-sans antialiased h-full">
    <div x-data="{
        dropdownOpen: false,
        selectedVersion: '{{ $selectedVersion->version }}',
        versions: {{ $versions->pluck('version') }}
    }" class="min-h-screen bg-white dark:bg-bgDark">
        <!-- Navbar -->
        <nav id="navbar" :class="{ 'z-50': dropdownOpen, 'z-20': !dropdownOpen }"
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
                                    class="{{ Route::is('docs.*') ? 'hidden md:block' : 'hidden' }} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                                <x-application-logo
                                    class="{{ Route::is('docs.*') ? 'block md:hidden' : 'hidden' }} h-6 w-auto fill-current text-primaryDark dark:text-white" />
                            </a>
                        </div>

                        <div class="relative inline-block text-left">
                            <div>
                                <button @click="dropdownOpen = !dropdownOpen" type="button"
                                    class="text-xs leading-5 font-semibold text-gray-500 dark:text-gray-400 bg-gray-400/10 dark:bg-gray-800 rounded-full py-1 px-3 flex items-center space-x-2 hover:bg-gray-400/20 dark:hover:bg-gray-700 transition"
                                    id="options-menu" aria-haspopup="true" x-bind:aria-expanded="dropdownOpen">
                                    v<span x-text="selectedVersion"></span>
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" style="display: none;"
                                class="origin-top-left absolute left-0 mt-2 w-24 rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-gray-900/10 dark:bg-gray-900 dark:ring-0"
                                role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <div role="none">
                                    @foreach ($versions as $version)
                                        <a href="{{ route('docs.show', ['version' => $version->version]) }}"
                                            class="flex justify-between w-full p-1 text-xs leading-5 font-semibold rounded-md text-gray-500 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600/30 {{ $version->version === $selectedVersion->version ? 'text-purple-500 dark:text-purple-500 hover:text-purple-600 hover:dark:text-purple-600' : '' }}"
                                            role="menuitem">
                                            <span>v{{ $version->version }}</span>
                                            <svg class="h-5 w-5 text-purple-500 {{ $version->version === $selectedVersion->version ? 'block' : 'hidden' }}"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex h-max ml-auto">
                        <!-- Navigation Links -->
                        <div class="hidden sm:flex items-center">
                            <a href="{{ route('docs.show') }}"
                                class="text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-primary dark:hover:text-primary transition">Docs</a>
                        </div>

                        <div class="flex items-center border-l border-gray-200 ml-6 pl-4 gap-4 dark:border-gray-800">
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

                <!-- Docs Sidebar Button  -->
                <div class="w-6 h-6 {{ Route::is('docs.*') ? 'flex' : 'hidden' }}">
                    <div x-data="{ open: false }">
                        <button
                            @click="open = !open; document.documentElement.classList.toggle('overflow-hidden', open)"
                            class="inline-flex items-center justify-center rounded text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute top-0 right-0 h-screen w-full z-50 backdrop-blur-sm" role="dialog"
                            aria-modal="true" style="display: none;">
                            <div x-show="open" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute top-0 left-0 h-screen w-full bg-gray-500/70 transition-opacity dark:bg-gray-900/70"
                                @click="open = false; document.documentElement.classList.remove('overflow-hidden')"
                                aria-hidden="true">
                            </div>

                            <div x-show="open"
                                @click.away="open = false; document.documentElement.classList.remove('overflow-hidden')"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="-translate-x-full"
                                class="h-screen w-max transform divide-y divide-gray-100 overflow-scroll bg-white dark:bg-bgDark shadow-2xl transition-all">

                                <aside class="flex flex-col w-80 px-4 py-6">
                                    <nav class="flex-1 space-y-4">
                                        <div class="lg:text-sm lg:leading-6 relative pb-20">
                                            <div class="space-y-6">
                                                <!-- Navigation Links -->
                                                <div class="space-y-2">
                                                    <ul class="space-y-1">
                                                        <li>
                                                            <a href="{{ route('docs.show', ['version' => $selectedVersion->version]) }}"
                                                                class="flex items-center gap-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white group transition {{ !$selectedComponent ? 'font-semibold text-purple-500 dark:text-purple-500 hover:text-purple-600 hover:dark:text-purple-600' : '' }}">
                                                                <div
                                                                    class="p-1 border border-gray-200 dark:border-gray-800 rounded-md">
                                                                    <svg class="h-5 w-5 text-gray-700 dark:text-gray-400 group-hover:text-purple-600 transition {{ !$selectedComponent ? 'text-purple-500 dark:text-purple-500' : '' }}"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                Documentation
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @foreach ($categories as $category)
                                                    <div class="pb-4">
                                                        <h3
                                                            class="mb-4 capitalize font-semibold text-gray-900 dark:text-gray-200">
                                                            {{ $category->category }}
                                                        </h3>
                                                        <ul
                                                            class="ml-2 border-l-2 border-gray-200 dark:border-gray-800 space-y-2">
                                                            @foreach ($category->components as $component)
                                                                <li class="relative pl-2 group">
                                                                    <!-- Absolute line -->
                                                                    <div
                                                                        class="absolute top-0 bottom-0 -left-[2px] w-[2px] transition-colors duration-300
                                                                                {{ $selectedComponent && $selectedComponent->id === $component->id ? 'bg-purple-600' : 'bg-transparent group-hover:bg-gray-600' }}">
                                                                    </div>
                                                                    <!-- Link -->
                                                                    <a href="{{ route('docs.show', ['version' => $selectedVersion->version, 'category' => $category->category, 'component' => $component->component]) }}"
                                                                        class="flex capitalize text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition
                                                                                {{ $selectedComponent && $selectedComponent->id === $component->id ? 'font-semibold text-purple-500 dark:text-purple-500 hover:text-purple-600 hover:dark:text-purple-600' : '' }}">
                                                                        {{ $component->component }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </nav>
                                </aside>
                            </div>
                        </div>
                    </div>
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
                        class="hidden lg:block fixed z-40 inset-0 top-[4.05rem] left-0 right-auto w-[17rem] pb-10 pl-8 pr-6 overflow-y-auto overflow-x-hidden">
                        <aside class="w-56">
                            <nav class="lg:text-sm lg:leading-6 relative pb-20">
                                <!-- Search -->
                                <div class="sticky top-0 z-50">
                                    <div class="h-8 bg-white dark:bg-bgDark"></div>
                                    <div class="relative pointer-events-auto">
                                        <x-sidebar-search />
                                    </div>
                                    <div class="h-8 bg-gradient-to-b from-white dark:from-bgDark"></div>
                                </div>

                                <div class="px-2 space-y-6">
                                    <!-- Navigation Links -->
                                    <div class="space-y-2">
                                        <ul class="space-y-1">
                                            <li>
                                                <a href="{{ route('docs.show', ['version' => $selectedVersion->version]) }}"
                                                    class="flex items-center gap-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white group transition {{ !$selectedComponent ? 'font-semibold text-purple-500 dark:text-purple-500 hover:text-purple-600 hover:dark:text-purple-600' : '' }}">
                                                    <div
                                                        class="p-1 border border-gray-200 dark:border-gray-800 rounded-md">
                                                        <svg class="h-5 w-5 text-gray-700 dark:text-gray-400 group-hover:text-purple-600 transition {{ !$selectedComponent ? 'text-purple-500 dark:text-purple-500' : '' }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    Documentation
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="pb-4">
                                            <h3 class="mb-4 capitalize font-semibold text-gray-900 dark:text-gray-200">
                                                {{ $category->category }}
                                            </h3>
                                            <ul class="ml-2 border-l-2 border-gray-200 dark:border-gray-800 space-y-2">
                                                @foreach ($category->components as $component)
                                                    <li class="relative pl-2 group">
                                                        <!-- Absolute line -->
                                                        <div
                                                            class="absolute top-0 bottom-0 -left-[2px] w-[2px] transition-colors duration-300
                                                                    {{ $selectedComponent && $selectedComponent->id === $component->id ? 'bg-purple-600' : 'bg-transparent group-hover:bg-gray-600' }}">
                                                        </div>
                                                        <!-- Link -->
                                                        <a href="{{ route('docs.show', ['version' => $selectedVersion->version, 'category' => $category->category, 'component' => $component->component]) }}"
                                                            class="flex capitalize text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition
                                                                    {{ $selectedComponent && $selectedComponent->id === $component->id ? 'font-semibold text-purple-500 dark:text-purple-500 hover:text-purple-600 hover:dark:text-purple-600' : '' }}">
                                                            {{ $component->component }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </nav>
                        </aside>
                    </div>

                    <!-- Main Content -->
                    <div class="min-h-[calc(100vh-114px)]">
                        <div class="min-h-[calc(100vh-70px)] lg:pl-[270px] flex flex-col justify-between">
                            <div class="w-full py-6 sm:py-8">
                                <main class="">
                                    @if ($selectedComponent)
                                        <div class="grid grid-cols-1 xl:grid-cols-7">
                                            <!-- Content -->
                                            <div class="col-span-6">
                                                <h1 class="-mb-6 text-sm leading-6 font-semibold text-purple-500">
                                                    {{ $selectedComponent->category->category }}
                                                </h1>

                                                <div id="overview" class="pt-8">
                                                    <h2
                                                        class="flex group text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight dark:text-gray-200">
                                                        {{ $selectedComponent->component }}
                                                        <a href="#overview"
                                                            class="ml-2 flex items-center opacity-0 border-0 group-hover:opacity-100 text-purple-500"
                                                            aria-label="Anchor">#</a>
                                                    </h2>
                                                </div>

                                                @if ($selectedComponent->note)
                                                    <div class="mt-4 quill-content">
                                                        {!! $selectedComponent->note !!}
                                                    </div>
                                                @endif

                                                <div id="live-preview" class="">
                                                    <h2
                                                        class="mb-2 group flex font-bold text-gray-900 dark:text-gray-200">
                                                        Live Preview
                                                        <a href="#live-preview"
                                                            class="ml-2 flex items-center opacity-0 border-0 group-hover:opacity-100 text-purple-500"
                                                            aria-label="Anchor">#</a>
                                                    </h2>
                                                    <div class="relative">
                                                        <div
                                                            class="absolute top-0 right-0 left-0 flex justify-between items-center px-4 py-2 border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 rounded-t-md">
                                                            <span
                                                                class="text-sm font-medium text-gray-900 dark:text-gray-200">Live
                                                                Preview</span>
                                                        </div>
                                                        <div
                                                            class="pt-14 px-4 pb-4 rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                                            <iframe
                                                                src="{{ route('preview.show', $selectedComponent) }}"
                                                                class="w-full h-[550px] bg-white dark:bg-bgDark rounded shadow"
                                                                frameborder="0" loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="html" class="pt-8" x-data="{ copied: false }">
                                                    <h2
                                                        class="mb-2 group flex font-bold text-gray-900 dark:text-gray-200">
                                                        HTML
                                                        <a href="#html"
                                                            class="ml-2 flex items-center opacity-0 border-0 group-hover:opacity-100 text-purple-500"
                                                            aria-label="Anchor">#</a>
                                                    </h2>
                                                    <div class="relative">
                                                        <div
                                                            class="absolute top-0 right-0 left-0 flex justify-between items-center px-4 py-2 border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 rounded-t-md">
                                                            <span
                                                                class="text-sm font-medium text-gray-900 dark:text-gray-200">HTML</span>
                                                            <button
                                                                @click="copied = !copied; copyToClipboard($refs.htmlCode.textContent); setTimeout(() => copied = !copied, 1000)"
                                                                class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none group"
                                                                aria-label="Copy HTML code">
                                                                <svg x-show="!copied" class="h-5 w-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                                <svg x-show="copied"
                                                                    class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                                                    style="display: none;" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                <span x-show="!copied"
                                                                    class="tooltip hidden group-hover:block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copy</span>
                                                                <span x-show="copied" style="display: none;"
                                                                    class="tooltip block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copied!</span>
                                                            </button>
                                                        </div>
                                                        <pre x-ref="htmlCode"
                                                            class="border border-gray-200 bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 pt-10 pb-4 rounded-lg overflow-auto"><code>{{ $selectedComponent->html }}</code></pre>
                                                    </div>
                                                </div>

                                                <div id="css" class="pt-8" x-data="{ copied: false }">
                                                    <h2
                                                        class="mb-2 group flex font-bold text-gray-900 dark:text-gray-200">
                                                        CSS/SCSS
                                                        <a href="#css"
                                                            class="ml-2 flex items-center opacity-0 border-0 group-hover:opacity-100 text-purple-500"
                                                            aria-label="Anchor">#</a>
                                                    </h2>
                                                    <div class="relative">
                                                        <div
                                                            class="absolute top-0 right-0 left-0 flex justify-between items-center px-4 py-2 border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 rounded-t-md">
                                                            <span
                                                                class="text-sm font-medium text-gray-900 dark:text-gray-200">CSS/SCSS</span>
                                                            <button
                                                                @click="copied = !copied; copyToClipboard($refs.cssCode.textContent); setTimeout(() => copied = !copied, 1000)"
                                                                class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none group"
                                                                aria-label="Copy CSS/SCSS code">
                                                                <svg x-show="!copied" class="h-5 w-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                                <svg x-show="copied"
                                                                    class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                                                    style="display: none;" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                <span x-show="!copied"
                                                                    class="tooltip hidden group-hover:block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copy</span>
                                                                <span x-show="copied" style="display: none;"
                                                                    class="tooltip block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copied!</span>
                                                            </button>
                                                        </div>
                                                        <pre x-ref="cssCode"
                                                            class="border border-gray-200 bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 pt-10 pb-4 rounded-lg overflow-auto"><code>{{ $selectedComponent->scss }}</code></pre>
                                                    </div>
                                                </div>

                                                @if ($selectedComponent->js)
                                                    <div id="javascript" class="pt-8" x-data="{ copied: false }">
                                                        <h2
                                                            class="mb-2 group flex font-bold text-gray-900 dark:text-gray-200">
                                                            JavaScript
                                                            <a href="#javascript"
                                                                class="ml-2 flex items-center opacity-0 border-0 group-hover:opacity-100 text-purple-500"
                                                                aria-label="Anchor">#</a>
                                                        </h2>
                                                        <div class="relative">
                                                            <div
                                                                class="absolute top-0 right-0 left-0 flex justify-between items-center px-4 py-2 border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 rounded-t-md">
                                                                <span
                                                                    class="text-sm font-medium text-gray-900 dark:text-gray-200">JavaScript</span>
                                                                <button
                                                                    @click="copied = !copied; copyToClipboard($refs.jsCode.textContent); setTimeout(() => copied = !copied, 1000)"
                                                                    class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none group"
                                                                    x-data="{ copied: false }">
                                                                    <svg x-show="!copied" class="h-5 w-5"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                        </path>
                                                                    </svg>
                                                                    <svg x-show="copied"
                                                                        class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                                                        style="display: none;" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M5 13l4 4L19 7"></path>
                                                                    </svg>
                                                                    <span x-show="!copied"
                                                                        class="tooltip hidden group-hover:block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copy</span>
                                                                    <span x-show="copied" style="display: none;"
                                                                        class="tooltip block absolute -top-2 left-1/2 -translate-x-1/2 -translate-y-full px-2 py-1 bg-gray-800 text-white text-xs rounded">Copied!</span>
                                                                </button>
                                                            </div>
                                                            <pre x-ref="jsCode"
                                                                class="border border-gray-200 bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 pt-10 pb-4 rounded-lg overflow-auto"><code>{{ $selectedComponent->js }}</code></pre>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- On this page -->
                                            <div
                                                class="fixed z-10 top-[4.05rem] bottom-0 right-0 left-auto w-[160px] pt-8 pr-8 overflow-y-auto hidden xl:block">
                                                <h1
                                                    class="mb-4 text-sm leading-6 font-semibold text-gray-900 dark:text-gray-200">
                                                    On
                                                    this page</h1>
                                                <ul class="ml-1 space-y-2 text-sm" id="on-this-page-nav">
                                                    <li>
                                                        <a href="#overview"
                                                            class="pl-3 text-gray-600 hover:text-purple-500 dark:text-gray-300 dark:hover:text-purple-500 transition">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#live-preview"
                                                            class="pl-3 text-gray-600 hover:text-purple-500 dark:text-gray-300 dark:hover:text-purple-500 transition">
                                                            Live Preview
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#html"
                                                            class="pl-3 text-gray-600 hover:text-purple-500 dark:text-gray-300 dark:hover:text-purple-500 transition">
                                                            HTML
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#css"
                                                            class="pl-3 text-gray-600 hover:text-purple-500 dark:text-gray-300 dark:hover:text-purple-500 transition">
                                                            CSS/SCSS
                                                        </a>
                                                    </li>
                                                    @if ($selectedComponent && $selectedComponent->js)
                                                        <li>
                                                            <a href="#javascript"
                                                                class="pl-3 text-gray-600 hover:text-purple-500 dark:text-gray-300 dark:hover:text-purple-500 transition">
                                                                JavaScript
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <h1 class="mb-2 text-sm leading-6 font-semibold text-purple-500">Overview</h1>
                                        <h1
                                            class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                                            Documentation
                                        </h1>
                                        <p class="mt-4 text-gray-600 dark:text-gray-300">Welcome to the documentation
                                            for version
                                            {{ $selectedVersion->version }}.</p>
                                    @endif
                                </main>
                            </div>

                            <!-- Footer -->
                            <footer class="border-t border-gray-200 dark:border-gray-800">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('#on-this-page-nav a');
            const sections = document.querySelectorAll('div[id]');
            const headingLinks = document.querySelectorAll('h2 a');

            function setActiveLink() {
                let currentSection = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.pageYOffset >= sectionTop - 100) {
                        currentSection = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('text-purple-500', 'dark:text-purple-500', 'font-semibold',
                        'border-l-2', 'border-purple-500');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('text-purple-500', 'dark:text-purple-500', 'font-semibold',
                            'border-l-2', 'border-purple-500');
                    }
                });
            }

            function smoothScroll(target) {
                const targetElement = document.querySelector(target);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 60,
                        behavior: 'smooth'
                    });
                }
            }

            window.addEventListener('scroll', setActiveLink);
            setActiveLink(); // Call once to set initial state

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('href');
                    smoothScroll(target);
                });
            });

            headingLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('href');
                    smoothScroll(target);
                });
            });
        });
    </script>
</body>

</html>
