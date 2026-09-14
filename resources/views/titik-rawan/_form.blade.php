@php
    $titikRawan ??= null;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h6 class="text-uppercase text-body-secondary small fw-bold mb-3">
    <i class="cil-info me-1"></i> Informasi Umum
</h6>

<div class="mb-3">
    <label for="nama" class="form-label">Nama Titik</label>
    <input
        type="text"
        name="nama"
        id="nama"
        class="form-control"
        value="{{ old('nama', $titikRawan->nama ?? '') }}"
        required
    >
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="kota_kabupaten" class="form-label">Kota/Kabupaten</label>
        <input
            type="text"
            name="kota_kabupaten"
            id="kota_kabupaten"
            class="form-control"
            value="{{ old('kota_kabupaten', $titikRawan->kota_kabupaten ?? '') }}"
        >
    </div>
    <div class="col-md-6">
        <label for="kategori" class="form-label">Kategori</label>
        <input
            type="text"
            name="kategori"
            id="kategori"
            class="form-control"
            placeholder="Misal: Rawan Banjir, Rawan Kecelakaan"
            value="{{ old('kategori', $titikRawan->kategori ?? '') }}"
        >
    </div>
</div>

<h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
    <i class="cil-boat-alt me-1"></i> Detail Kapal &amp; Akses
</h6>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label for="jenis_kapal" class="form-label">Jenis Kapal</label>
        <input
            type="text"
            name="jenis_kapal"
            id="jenis_kapal"
            class="form-control"
            value="{{ old('jenis_kapal', $titikRawan->jenis_kapal ?? '') }}"
        >
    </div>
    <div class="col-md-4">
        <label for="akses" class="form-label">Akses</label>
        <select name="akses" id="akses" class="form-select">
            <option value="">- Pilih -</option>
            @foreach (['Terbuka', 'Terbatas', 'Tertutup'] as $opsi)
                <option value="{{ $opsi }}" @selected(old('akses', $titikRawan->akses ?? '') === $opsi)>{{ $opsi }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="jangkauan" class="form-label">Jangkauan</label>
        <input
            type="text"
            name="jangkauan"
            id="jangkauan"
            class="form-control"
            placeholder="Misal: 12 s.d. 24 Jam (60 ML)"
            value="{{ old('jangkauan', $titikRawan->jangkauan ?? '') }}"
        >
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="tempat_sandar" class="form-label">Tempat Sandar</label>
        <input
            type="text"
            name="tempat_sandar"
            id="tempat_sandar"
            class="form-control"
            value="{{ old('tempat_sandar', $titikRawan->tempat_sandar ?? '') }}"
        >
    </div>
    <div class="col-md-6">
        <label for="mpm" class="form-label">Mata Pencaharian Masyarakat (MPM)</label>
        <input
            type="text"
            name="mpm"
            id="mpm"
            class="form-control"
            value="{{ old('mpm', $titikRawan->mpm ?? '') }}"
        >
    </div>
</div>

<h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
    <i class="cil-map me-1"></i> Lokasi
</h6>

<div class="mb-3">
    <label class="form-label">Klik peta atau geser marker untuk menentukan titik</label>
    <div id="peta-pilih-lokasi" style="height: 360px; width: 100%;" class="rounded border mb-2"></div>
    <div class="row g-2">
        <div class="col-sm-6">
            <label for="latitude" class="form-label small text-body-secondary">Latitude</label>
            <input
                type="text"
                name="latitude"
                id="latitude"
                class="form-control"
                value="{{ old('latitude', $titikRawan->latitude ?? '') }}"
                required
            >
        </div>
        <div class="col-sm-6">
            <label for="longitude" class="form-label small text-body-secondary">Longitude</label>
            <input
                type="text"
                name="longitude"
                id="longitude"
                class="form-control"
                value="{{ old('longitude', $titikRawan->longitude ?? '') }}"
                required
            >
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="link_maps" class="form-label">Link Google Maps Referensi (opsional)</label>
    <div class="input-group">
        <span class="input-group-text"><i class="cil-link"></i></span>
        <input
            type="url"
            name="link_maps"
            id="link_maps"
            class="form-control"
            placeholder="https://maps.app.goo.gl/..."
            value="{{ old('link_maps', $titikRawan->link_maps ?? '') }}"
        >
    </div>
</div>

<h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
    <i class="cil-image me-1"></i> Media &amp; Keterangan
</h6>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Keterangan</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $titikRawan->deskripsi ?? '') }}</textarea>
</div>

<div class="mb-2">
    <label for="foto" class="form-label">Foto</label>
    @if ($titikRawan && $titikRawan->fotoUrl())
        <div class="mb-2">
            <img src="{{ $titikRawan->fotoUrl() }}" alt="{{ $titikRawan->nama }}" style="max-height:120px;" class="rounded d-block">
        </div>
    @endif
    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
    <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
</div>
