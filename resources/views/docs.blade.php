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
            <!-- Navbar -->
            <x-navbar/>
    
            <!-- Page Content -->
            <div class="min-h-[calc(100vh-114px)]">
                <div class="overflow-hidden">
                    <div class="mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Sidebar -->
                        <div class="hidden lg:block fixed z-50 inset-0 top-[4.05rem] left-0 right-auto w-80 pb-10 pl-8 pr-6 overflow-y-auto">
                            <x-sidebar-docs/>
                        </div>

                        <!-- Content -->
                        <div class="min-h-[calc(100vh-114px)]">
                            <main class="lg:pl-80">
                                <div class="w-full py-6 sm:py-8">
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                    <header id="header" class="mb-10 md:flex md:items-start"><div class="flex-auto max-w-4xl"><p class="mb-4 text-sm leading-6 font-semibold text-sky-500 dark:text-sky-400">Installation</p><h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">Get started with Tailwind CSS</h1><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your HTML files, JavaScript components, and any other templates for class names, generating the corresponding styles and then writing them to a static CSS file.</p><p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with zero-runtime.</p></div></header>
                                </div>

                                <!-- Footer -->
                                <footer class="pb-8 border-t border-gray-200 dark:border-gray-800">
                                    <div class="h-14 sm:h-12 flex flex-col-reverse sm:flex-row gap-2 sm:justify-between justify-center items-center">
                                        <div class="text-xs text-gray-900 dark:text-gray-200">
                                            © 2024 Detikcom Frontend Designer Team
                                        </div>
                                        <div class="flex gap-4">
                                            <a href="#" class="text-xs text-gray-700 dark:text-gray-200 hover:underline">
                                                Privacy Policy
                                            </a>
                                            <a href="#" class="text-xs text-gray-700 dark:text-gray-200 hover:underline">
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
