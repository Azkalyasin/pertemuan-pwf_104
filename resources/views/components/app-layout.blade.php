<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product CRUD Tailwind</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html> 