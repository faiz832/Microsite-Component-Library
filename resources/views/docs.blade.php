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
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased h-full">
        <div class="min-h-screen bg-white dark:bg-bgDark">
            <x-navbar/>
    
            <!-- Page Content -->
            <div class="min-h-[calc(100vh-114px)]">
               
            </div>
    
            <x-footer/>
        </div>
    </body>
</html>
