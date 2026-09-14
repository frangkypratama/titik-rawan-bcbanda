@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="card">
        <div class="card-header"><i class="cil-plus me-2"></i>Tambah User</div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @include('users._form')

                <div class="d-flex gap-2 pt-3 mt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
