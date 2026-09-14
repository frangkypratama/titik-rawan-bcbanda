@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $totalTitik }}</div>
                        <div class="small">Total Titik Rawan</div>
                    </div>
                    <i class="cil-location-pin icon icon-2xl"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $totalKota }}</div>
                        <div class="small">Kota/Kabupaten Terjangkau</div>
                    </div>
                    <i class="cil-map icon icon-2xl"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $totalJenisKapal }}</div>
                        <div class="small">Jenis Kapal Terdata</div>
                    </div>
                    <i class="cil-boat-alt icon icon-2xl"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $perluVerifikasi }}</div>
                        <div class="small">Perlu Verifikasi Koordinat</div>
                    </div>
                    <i class="cil-warning icon icon-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="cil-map me-2"></i>Peta Titik Rawan</span>
            <a href="{{ route('titik-rawan.index') }}" class="btn btn-primary btn-sm">
                <i class="cil-list me-1"></i> Lihat Data Titik Rawan
            </a>
        </div>
        <div class="card-body p-0">
            <div id="peta-titik-rawan" style="height: 480px; width: 100%;"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            initTitikRawanMap('peta-titik-rawan', @json($titikRawanPoints));
        });
    </script>
@endpush
