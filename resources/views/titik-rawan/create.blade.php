@extends('layouts.app')

@section('title', 'Tambah Titik Rawan')

@section('content')
    <div class="card">
        <div class="card-header"><i class="cil-plus me-2"></i>Tambah Titik Rawan</div>
        <div class="card-body">
            <form action="{{ route('titik-rawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('titik-rawan._form')

                <div class="d-flex gap-2 pt-3 mt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Simpan
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
            initPickerMap('peta-pilih-lokasi', 'latitude', 'longitude', null, null);
        });
    </script>
@endpush
