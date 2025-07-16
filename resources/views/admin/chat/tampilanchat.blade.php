@extends('layout.admin_template')

@section('title', 'Chat ' . $siswa->name)

@section('content')
<style>
    .chat-card { background: #fff; border-radius: 1rem; box-shadow: 0 6px 18px rgba(0,0,0,0.05); }
    .chat-header { background: linear-gradient(90deg, #2f39f3, #5f6af7); color: #fff; padding: 1rem 1.5rem; border-top-left-radius: 1rem; border-top-right-radius: 1rem; font-weight: 600; }
    .chat-body { max-height: 450px; overflow-y: auto; background: #f8f9fb; padding: 1.2rem 1.5rem; }
    .chat-footer { padding: 1rem 1.5rem; background: #fff; border-top: 1px solid #eee; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; }
    .btn-kirim { background: #2f39f3; color: #fff; }
    .btn-kirim:hover { background: #1f28d7; }
    .chat-bubble-user { background: #2f39f3; color: #fff; padding: 0.75rem 1rem; border-radius: 1rem; max-width: 70%; white-space: pre-wrap; }
    .chat-bubble-admin { background: #fff; color: #333; padding: 0.75rem 1rem; border-radius: 1rem; border: 1px solid #e2e5ec; max-width: 70%; white-space: pre-wrap; }
    .chat-meta { font-size: 10px; opacity: 0.7; margin-top: 0.4rem; text-align: right; }
</style>

<div class="container py-3">
    <div class="card chat-card">
        <div class="chat-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-chat-dots-fill me-2"></i> Chat dengan {{ $siswa->name }}</h5>
            <span class="badge bg-light text-dark">● Online</span>
        </div>

        <div id="chat-box" class="chat-body">
            @foreach ($chats as $chat)
                @if ($chat->sender_id === auth()->id())
                    <div class="mb-3 d-flex justify-content-end">
                        <div class="chat-bubble-user">
                            <small class="d-block mb-1 fw-bold text-light">Anda (Admin):</small>
                            {{ $chat->pesan }}
                            <div class="chat-meta text-light">{{ $chat->created_at->format('d M Y H:i') }}</div>
                        </div>
                    </div>
                @else
                    <div class="mb-3 d-flex justify-content-start">
                        <div class="chat-bubble-admin">
                            <small class="d-block mb-1 text-muted fw-bold">{{ $chat->sender->name ?? 'User' }}:</small>
                            {{ $chat->pesan }}
                            <div class="chat-meta text-muted">{{ $chat->created_at->format('d M Y H:i') }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="chat-footer">
            <form method="POST" action="{{ route('admin.chat.send') }}">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $siswa->id }}">
                <div class="input-group">
                    <input type="text" name="pesan" class="form-control rounded-pill shadow-sm border-0 px-3" placeholder="Tulis balasan..." required>
                    <button class="btn btn-kirim rounded-pill px-4 shadow-sm ms-2" type="submit">
                        <i class="bi bi-send-fill me-1"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chatBox = document.getElementById("chat-box");
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>
@endsection
