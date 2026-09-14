<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
            <div class="container" style="max-width: 32rem">
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;flex-shrink:0;">
                            <i class="cil-location-pin text-white"></i>
                        </div>
                        <span class="fs-4 fw-semibold">{{ config('app.name') }}</span>
                    </div>

                    <div class="card p-4">
                        <div class="card-body d-flex flex-column gap-4">
                            <h2 class="h5 text-center">Masuk ke akun Anda</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger mb-0">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="row gap-3" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div>
                                    <label class="form-label" for="nip">NIP</label>
                                    <input
                                        class="form-control"
                                        id="nip"
                                        name="nip"
                                        type="text"
                                        placeholder="Masukkan NIP"
                                        value="{{ old('nip') }}"
                                        autofocus
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group">
                                        <input
                                            class="form-control"
                                            id="password"
                                            name="password"
                                            type="password"
                                            placeholder="Masukkan password"
                                            required
                                        >
                                        <span class="input-group-text">
                                            <button
                                                class="bg-transparent border-0 p-0 link-secondary"
                                                type="button"
                                                id="toggle-password"
                                                aria-label="Tampilkan password"
                                            >
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentcolor" d="M256 144.927a103.309 103.309 0 1 0 103.309 103.309A103.426 103.426 0 0 0 256 144.927m0 174.618a71.309 71.309 0 1 1 71.309-71.309A71.39 71.39 0 0 1 256 319.545"></path>
                                                    <path fill="currentcolor" d="m397.222 131.1-.218-.223c-77.75-77.749-204.258-77.749-282.008 0L16 233.79v28.893l98.778 102.689.218.222a199.41 199.41 0 0 0 282.008 0l99-102.911V233.79ZM464 249.79l-89.732 93.285a167.41 167.41 0 0 1-236.536 0L48 249.79v-3.107l89.729-93.283c65.247-65.13 171.3-65.13 236.542 0L464 246.683Z"></path>
                                                    <path fill="currentcolor" d="M240 232h32v32h-32z"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember">
                                        <span class="form-check-label">Ingat saya di perangkat ini</span>
                                    </label>
                                </div>

                                <div>
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('toggle-password').addEventListener('click', function () {
                const input = document.getElementById('password');
                const showing = input.type === 'text';

                input.type = showing ? 'password' : 'text';
                this.setAttribute('aria-label', showing ? 'Tampilkan password' : 'Sembunyikan password');
            });
        </script>
    </body>
</html>
