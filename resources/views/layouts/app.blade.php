<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Dashboard') &middot; {{ config('app.name', 'Laravel') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.sidebar')

        <div class="wrapper d-flex flex-column min-vh-100 bg-body-tertiary">
            @include('partials.header')

            <div class="body flex-grow-1">
                <div class="@yield('container-class', 'container-fluid') px-4">
                    @yield('content')
                </div>
            </div>

            <footer class="footer px-4">
                <div>{{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }}</div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
