@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="cil-people me-2"></i>User Management</span>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class="cil-plus me-1"></i> Tambah User
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Bergabung</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary-subtle text-primary-emphasis rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="fw-semibold">
                                            {{ $user->name }}
                                            @if ($user->id === auth()->id())
                                                <span class="badge bg-secondary-subtle text-secondary-emphasis ms-1">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="font-monospace">{{ $user->nip ?: '-' }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="small text-body-secondary">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="cil-pencil"></i>
                                    </a>
                                    @if ($user->id !== auth()->id())
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus"
                                            data-coreui-toggle="modal"
                                            data-coreui-target="#modal-hapus"
                                            data-delete-url="{{ route('users.destroy', $user) }}"
                                            data-delete-label="{{ $user->name }}"
                                        >
                                            <i class="cil-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-body-secondary py-5">
                                    <i class="cil-inbox icon icon-xl mb-2 d-block"></i>
                                    Belum ada user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer">
                {{ $users->links('vendor.pagination.coreui') }}
            </div>
        @endif
    </div>
@endsection
