<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VueLaravel</title>
        @routes
        @vite('resources/js/app.js')
        @inertiaHead



    </head>
    <!-- dark:bg-gray-900 -->
    <!-- dark:text-gray-300 -->
    <body class="bg-white text-gray-800   ">
    @inertia
    </body>
</html>
