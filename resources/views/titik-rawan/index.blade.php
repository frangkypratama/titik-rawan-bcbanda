@extends('layouts.app')

@section('title', 'Data Titik Rawan')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="cil-location-pin me-2"></i>Data Titik Rawan</span>
            <a href="{{ route('titik-rawan.create') }}" class="btn btn-primary btn-sm">
                <i class="cil-plus me-1"></i> Tambah Titik
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kota/Kabupaten</th>
                            <th>Jenis Kapal / Akses</th>
                            <th>Koordinat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($titikRawans as $titik)
                            <tr
                                role="button"
                                title="Klik dua kali untuk melihat detail"
                                ondblclick="if (!event.target.closest('.col-aksi')) { window.location = '{{ route('titik-rawan.show', $titik) }}'; }"
                            >
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary-subtle text-primary-emphasis rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;">
                                            <i class="cil-location-pin"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $titik->nama }}</div>
                                            @if ($titik->kategori)
                                                <span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $titik->kategori }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $titik->kota_kabupaten ?: '-' }}</td>
                                <td class="small">
                                    @if ($titik->jenis_kapal)
                                        <div>{{ $titik->jenis_kapal }}</div>
                                    @else
                                        <span class="text-body-secondary">-</span>
                                    @endif
                                    @if ($titik->akses)
                                        <span class="badge bg-info-subtle text-info-emphasis mt-1">{{ $titik->akses }}</span>
                                    @endif
                                </td>
                                <td class="small">
                                    @if ($titik->latitude && $titik->longitude)
                                        <span class="font-monospace">{{ $titik->latitude }}, {{ $titik->longitude }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="cil-warning me-1"></i>Perlu Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td class="col-aksi text-center text-nowrap">
                                    @if ($titik->latitude && $titik->longitude)
                                        <a
                                            href="https://www.google.com/maps/dir/?api=1&destination={{ $titik->latitude }},{{ $titik->longitude }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="btn btn-sm btn-info text-white"
                                            title="Buka rute di Google Maps"
                                        >
                                            <i class="cil-map"></i>
                                        </a>
                                    @elseif ($titik->link_maps)
                                        <a
                                            href="{{ $titik->link_maps }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="btn btn-sm btn-info text-white"
                                            title="Buka link Google Maps referensi"
                                        >
                                            <i class="cil-link"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('titik-rawan.edit', $titik) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="cil-pencil"></i>
                                    </a>
                                    <form action="{{ route('titik-rawan.destroy', $titik) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus titik ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="cil-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-body-secondary py-5">
                                    <i class="cil-inbox icon icon-xl mb-2 d-block"></i>
                                    Belum ada titik rawan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($titikRawans->hasPages())
            <div class="card-footer">
                {{ $titikRawans->links('vendor.pagination.coreui') }}
            </div>
        @endif
    </div>
@endsection
