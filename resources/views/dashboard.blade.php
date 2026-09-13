<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard &middot; {{ config('app.name', 'Laravel') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <span class="navbar-brand">{{ config('app.name', 'Laravel') }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </nav>

        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4">Selamat datang, {{ auth()->user()->name }}</h1>
                    <p class="text-body-secondary mb-0">Anda berhasil login sebagai {{ auth()->user()->email }}.</p>
                </div>
            </div>
        </div>
    </body>
</html>
