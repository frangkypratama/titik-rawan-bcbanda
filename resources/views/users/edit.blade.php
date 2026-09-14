@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="card">
        <div class="card-header"><i class="cil-pencil me-2"></i>Edit User</div>
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

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('users._form', ['user' => $user])

                <div class="d-flex gap-2 pt-3 mt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
