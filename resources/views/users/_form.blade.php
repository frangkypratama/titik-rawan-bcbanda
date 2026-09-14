@php
    $user ??= null;
@endphp

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="{{ old('name', $user->name ?? '') }}"
            required
            autofocus
        >
    </div>
    <div class="col-md-6">
        <label for="nip" class="form-label">NIP</label>
        <input
            type="text"
            name="nip"
            id="nip"
            class="form-control"
            value="{{ old('nip', $user->nip ?? '') }}"
            required
        >
        <div class="form-text">Digunakan sebagai username untuk login.</div>
    </div>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input
        type="email"
        name="email"
        id="email"
        class="form-control"
        value="{{ old('email', $user->email ?? '') }}"
        required
    >
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="password" class="form-label">
            Password
            @if ($user)
                <span class="text-body-secondary fw-normal">(kosongkan jika tidak diubah)</span>
            @endif
        </label>
        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            {{ $user ? '' : 'required' }}
        >
    </div>
    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control"
            {{ $user ? '' : 'required' }}
        >
    </div>
</div>
