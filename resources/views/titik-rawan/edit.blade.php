@extends('layouts.app')

@section('title', 'Edit Titik Rawan')

@section('content')
    <div class="card">
        <div class="card-header"><i class="cil-pencil me-2"></i>Edit Titik Rawan</div>
        <div class="card-body">
            <form action="{{ route('titik-rawan.update', $titikRawan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('titik-rawan._form', ['titikRawan' => $titikRawan])

                <div class="d-flex gap-2 pt-3 mt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('titik-rawan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            initPickerMap(
                'peta-pilih-lokasi',
                'latitude',
                'longitude',
                {{ $titikRawan->latitude }},
                {{ $titikRawan->longitude }}
            );
        });
    </script>
@endpush
