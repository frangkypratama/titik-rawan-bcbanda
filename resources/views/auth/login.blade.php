<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login &middot; {{ config('app.name', 'Laravel') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary">
        <div class="min-vh-100 d-flex flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card-group shadow-sm">
                            <div class="card p-4">
                                <div class="card-body">
                                    <h1>Login</h1>
                                    <p class="text-body-secondary">Masuk ke akun Anda</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0 ps-3">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="cil-user"></i>
                                            </span>
                                            <input
                                                type="email"
                                                name="email"
                                                class="form-control"
                                                placeholder="Email"
                                                value="{{ old('email') }}"
                                                autofocus
                                                required
                                            >
                                        </div>

                                        <div class="input-group mb-4">
                                            <span class="input-group-text">
                                                <i class="cil-lock-locked"></i>
                                            </span>
                                            <input
                                                type="password"
                                                name="password"
                                                class="form-control"
                                                placeholder="Password"
                                                required
                                            >
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label" for="remember">
                                                Ingat saya
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary px-4">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card text-white bg-primary py-5 d-md-down-none" style="width: 44%">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <h2>{{ config('app.name', 'Laravel') }}</h2>
                                    <p>Silakan hubungi administrator jika Anda belum memiliki akun.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
