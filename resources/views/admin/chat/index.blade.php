@extends('layout.admin_template')

@section('title', 'Daftar Pengguna yang Chat')

@section('content')
<style>
    .bg-blue { background-color: #007bff !important; }
    .text-blue { color: #007bff !important; }
    .btn-outline-blue { color: #007bff; border-color: #007bff; }
    .btn-outline-blue:hover { background-color: #007bff; color: #fff; }
    .fw-semibold { font-weight: 600; }
</style>

<div class="card shadow">
    <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-chat-dots-fill me-1"></i> Pengguna yang Pernah Chat</h5>
    </div>

    <div class="card-body">
        @if($users->count())
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $user->sender->name }} ({{ $user->sender->email }})</span>
                        <a href="{{ route('admin.chat.show', ['siswa_id' => $user->sender->id]) }}">
                            Lihat Chat
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
