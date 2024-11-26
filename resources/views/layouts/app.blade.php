<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white dark:bg-bgDark">
            <x-navbar/>

            <div class="min-h-[calc(100vh-114px)]">
                <div class="flex gap-12 px-4 sm:px-6 md:px-8">
                    <!-- Sidebar -->
                    <x-sidebar />
                    
                    <!-- Content -->
                    <main class="w-full overflow-auto py-6 sm:py-12">
                        {{ $slot }}
                    </main>
                </div>
            </div>

            <!-- Footer -->
            <x-footer/>
        </div>
    </body>
</html>
