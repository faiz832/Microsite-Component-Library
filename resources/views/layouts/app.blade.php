<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

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
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white dark:bg-bgDark">
        <x-navbar />

        <div class="min-h-[calc(100vh-114px)]">
            <div class="overflow-hidden">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Sidebar -->
                    <div
                        class="hidden lg:block fixed z-40 inset-0 top-[4.05rem] left-0 right-auto w-80 pb-10 pl-8 pr-6 overflow-y-auto">
                        <x-sidebar />
                    </div>

                    <!-- Content -->
                    <div class="min-h-[calc(100vh-114px)]">
                        <main class="lg:pl-64">
                            <div class="w-full py-6 sm:py-8">
                                {{ $slot }}
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    <script>
        new DataTable('#dataTable');
    </script>
</body>

</html>
