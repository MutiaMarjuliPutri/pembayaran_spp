@extends('layout.admin_template')

@section('title', 'Data SPP')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-semibold mb-0">💰 Data SPP</h4>
                <a href="{{ route('spp.create') }}" class="btn btn-primary">
                    + Tambah SPP
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spp as $key => $data)
                        <tr class="text-center">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>Rp {{ number_format($data->nominal, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('spp.edit', $data->id) }}" class="btn btn-warning btn-sm me-1">
                                    ✏️ Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="hapusSPP({{ $data->id }})">
                                    🗑️ Hapus
                                </button>
                                <form id="form-hapus-{{ $data->id }}" action="{{ route('spp.destroy', $data->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data SPP.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Optional: SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function hapusSPP(id) {
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-hapus-' + id).submit();
            }
        })
    }
</script>
@endsection
