<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Microsite Component Library</title>

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
        <x-navbar />

        <!-- Page Content -->
        <div class="min-h-[calc(100vh-114px)] flex justify-center items-center">
            <div class="px-4 sm:px-6 md:px-8">
                <div class="relative max-w-5xl mx-auto py-14">
                    <h1
                        class="text-gray-900 font-extrabold text-4xl sm:text-5xl lg:text-6xl tracking-tight text-center dark:text-white">
                        Build responsive microsites easily and efficiently with the Microsite Component Library.</h1>
                    <p class="mt-6 text-lg text-gray-600 text-center max-w-3xl mx-auto dark:text-gray-400">
                        Cut your time with a set of pre-designed and customizable components, allowing developers to
                        easily create stunning and responsive microsites in no time.
                    </p>
                    <div class="mt-6 sm:mt-10 flex justify-center text-sm">
                        <a href="{{ route('docs.show') }}"
                            class="bg-gray-900 hover:bg-gray-700 focus:outline-none text-white font-semibold h-12 px-6 rounded-lg w-full flex items-center justify-center sm:w-auto dark:bg-purple-600 dark:highlight-white/20 dark:hover:bg-purple-500 transition">
                            Get started
                        </a>

                        <!-- Quick Search -->
                        <div class="hidden sm:flex items-center ml-6">
                            <x-hero-search />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />
    </div>
</body>

</html>
