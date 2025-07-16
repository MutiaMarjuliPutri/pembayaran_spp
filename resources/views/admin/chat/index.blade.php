@extends('layout.admin_template')

@section('title', 'Daftar Pengguna yang Chat')

@section('content')
<style>
    .bg-orange { background-color: #f9481e !important; }
    .text-orange { color: #f9481e !important; }
    .btn-outline-orange { color: #f9481e; border-color: #f9481e; }
    .btn-outline-orange:hover { background-color: #f9481e; color: #fff; }
    .fw-semibold { font-weight: 600; }
</style>

<div class="card shadow">
    <div class="card-header bg-orange text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-chat-dots-fill me-1"></i> Pengguna yang Pernah Chat</h5>
    </div>

    <div class="card-body">
        @if($users->count())
            <ul class="list-group">
    @foreach($users as $user)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ $user->sender->name }} ({{ $user->sender->email }})</span>
            <a href="{{ route('admin.chat.show', ['siswa_id' => $user->sender->id]) }}" 
               class="btn btn-sm btn-outline-orange fw-semibold">
                <i class="bi bi-chat-left-text me-1"></i> Lihat Chat
            </a>
        </li>
    @endforeach
</ul>

        @else
            <p class="text-center text-muted">Belum ada chat masuk dari siswa.</p>
        @endif
    </div>
</div>
@endsection
