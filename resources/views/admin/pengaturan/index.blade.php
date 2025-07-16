@extends('layout.admin_template')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">⚙️ Pengaturan Akun</h4>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-start">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge 
                                    @if($user->role == 'admin') bg-primary 
                                    @elseif($user->role == 'operator') bg-info text-dark 
                                    @else bg-secondary 
                                    @endif rounded-pill px-3 py-2">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if(Auth::id() != $user->id)
                                <form action="{{ route('pengaturan.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus akun ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-3 shadow-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                @else
                                <span class="badge bg-secondary rounded-pill px-3 py-2">Akun Anda</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center">Belum ada data akun.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
