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
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased h-full">
        <div class="min-h-screen bg-white dark:bg-bgDark">
            @include('layouts.navbar')
    
            <!-- Page Content -->
            <div class="min-h-[calc(100vh-130px)]">
                <div class="px-4 sm:px-6 md:px-8">
                    <div class="relative max-w-5xl mx-auto py-14 sm:pt-24 lg:pt-32">
                        <h1 class="text-slate-900 font-extrabold text-4xl sm:text-5xl lg:text-6xl tracking-tight text-center dark:text-white">Rapidly build responsive microsites effortlessly with Microsite Component Library.</h1>
                        <p class="mt-6 text-lg text-slate-600 text-center max-w-3xl mx-auto dark:text-slate-400">A utility-first CSS framework packed with classes like <code class="font-mono font-medium text-purple-600 dark:text-purple-500">flex</code>, <code class="font-mono font-medium text-purple-600 dark:text-purple-500">pt-4</code>, <code class="font-mono font-medium text-purple-600 dark:text-purple-500">text-center</code> and <code class="font-mono font-medium text-purple-600 dark:text-purple-500">rotate-90</code> that can be composed to build any design, directly in your markup.</p>
                        <div class="mt-6 sm:mt-10 flex justify-center space-x-6 text-sm">
                            <a class="bg-slate-900 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 focus:ring-offset-slate-50 text-white font-semibold h-12 px-6 rounded-lg w-full flex items-center justify-center sm:w-auto dark:bg-purple-600 dark:highlight-white/20 dark:hover:bg-purple-500 transition" href="/docs/installation">
                                Get started
                            </a>
                            <button type="button" class="hidden sm:flex items-center w-72 text-left space-x-3 px-4 h-12 bg-white ring-1 ring-slate-900/10 hover:ring-slate-300 focus:outline-none focus:ring-2 focus:ring-purple-600 shadow-sm rounded-lg text-slate-400 dark:bg-slate-800 dark:ring-0 dark:text-slate-300 dark:highlight-white/5 dark:hover:bg-slate-700">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-none text-slate-300 dark:text-slate-400" aria-hidden="true"><path d="m19 19-3.5-3.5"></path><circle cx="11" cy="11" r="6"></circle></svg><span class="flex-auto">Quick search...</span><kbd class="font-sans font-semibold dark:text-slate-500"><abbr title="Control" class="no-underline text-slate-300 dark:text-slate-500">Ctrl </abbr> K</kbd>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    
            @include('layouts.footer')
        </div>
    </body>
</html>
