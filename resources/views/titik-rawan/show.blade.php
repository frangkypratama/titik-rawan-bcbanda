@extends('layouts.app')

@section('title', 'Detail Titik Rawan')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="cil-location-pin me-2"></i>Detail Titik Rawan</span>
            <div>
                <a href="{{ route('titik-rawan.edit', $titikRawan) }}" class="btn btn-sm btn-primary">
                    <i class="cil-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('titik-rawan.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="cil-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <h6 class="text-uppercase text-body-secondary small fw-bold mb-3">
                <i class="cil-info me-1"></i> Informasi Umum
            </h6>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="small text-body-secondary">Nama Titik</div>
                    <div class="fw-semibold">{{ $titikRawan->nama }}</div>
                </div>
                <div class="col-md-6">
                    <div class="small text-body-secondary">Kota/Kabupaten</div>
                    <div class="fw-semibold">{{ $titikRawan->kota_kabupaten ?: '-' }}</div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="small text-body-secondary">Kategori</div>
                    <div>
                        @if ($titikRawan->kategori)
                            <span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $titikRawan->kategori }}</span>
                        @else
                            <span class="text-body-secondary">-</span>
                        @endif
                    </div>
                </div>
            </div>

            <h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
                <i class="cil-boat-alt me-1"></i> Detail Kapal &amp; Akses
            </h6>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="small text-body-secondary">Jenis Kapal</div>
                    <div class="fw-semibold">{{ $titikRawan->jenis_kapal ?: '-' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="small text-body-secondary">Akses</div>
                    <div>
                        @if ($titikRawan->akses)
                            <span class="badge bg-info-subtle text-info-emphasis">{{ $titikRawan->akses }}</span>
                        @else
                            <span class="text-body-secondary">-</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small text-body-secondary">Jangkauan</div>
                    <div class="fw-semibold">{{ $titikRawan->jangkauan ?: '-' }}</div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="small text-body-secondary">Tempat Sandar</div>
                    <div class="fw-semibold">{{ $titikRawan->tempat_sandar ?: '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="small text-body-secondary">Mata Pencaharian Masyarakat (MPM)</div>
                    <div class="fw-semibold">{{ $titikRawan->mpm ?: '-' }}</div>
                </div>
            </div>

            <h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
                <i class="cil-map me-1"></i> Lokasi
            </h6>

            <div class="mb-3">
                @if ($titikRawan->latitude && $titikRawan->longitude)
                    <div id="peta-lihat-lokasi" style="height: 320px; width: 100%;" class="rounded border mb-2"></div>
                    <div class="row g-2 mb-2">
                        <div class="col-sm-6">
                            <div class="small text-body-secondary">Latitude</div>
                            <div class="font-monospace">{{ $titikRawan->latitude }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-body-secondary">Longitude</div>
                            <div class="font-monospace">{{ $titikRawan->longitude }}</div>
                        </div>
                    </div>
                    <a
                        href="https://www.google.com/maps/dir/?api=1&destination={{ $titikRawan->latitude }},{{ $titikRawan->longitude }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-sm btn-info text-white"
                    >
                        <i class="cil-map me-1"></i> Buka Rute di Google Maps
                    </a>
                @else
                    <span class="badge bg-warning text-dark">
                        <i class="cil-warning me-1"></i>Koordinat Perlu Verifikasi
                    </span>
                    @if ($titikRawan->link_maps)
                        <a href="{{ $titikRawan->link_maps }}" target="_blank" rel="noopener" class="btn btn-sm btn-info text-white ms-2">
                            <i class="cil-link me-1"></i> Link Referensi
                        </a>
                    @endif
                @endif
            </div>

            <h6 class="text-uppercase text-body-secondary small fw-bold mb-3 mt-4 pt-3 border-top">
                <i class="cil-image me-1"></i> Media &amp; Keterangan
            </h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="small text-body-secondary mb-1">Foto</div>
                    @if ($titikRawan->fotoUrl())
                        <img src="{{ $titikRawan->fotoUrl() }}" alt="{{ $titikRawan->nama }}" class="rounded img-fluid" style="max-height:220px;">
                    @else
                        <div class="bg-body-tertiary rounded d-flex align-items-center justify-content-center" style="width:100%;height:150px;">
                            <i class="cil-image text-body-secondary icon-xl"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="small text-body-secondary mb-1">Keterangan</div>
                    <p class="mb-0">{{ $titikRawan->deskripsi ?: '-' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($titikRawan->latitude && $titikRawan->longitude)
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                initTitikRawanMap('peta-lihat-lokasi', [{
                    nama: @json($titikRawan->nama),
                    deskripsi: @json($titikRawan->deskripsi),
                    latitude: {{ $titikRawan->latitude }},
                    longitude: {{ $titikRawan->longitude }},
                    foto_url: @json($titikRawan->fotoUrl()),
                }]);
            });
        </script>
    @endpush
@endif
