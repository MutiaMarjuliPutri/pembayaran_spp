@extends('layout.siswa_template')

@section('title', 'Chat Admin')

@section('content')
<style>
    .chat-card {
        background: #ffffff;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    .chat-header {
        background: linear-gradient(90deg, #2f39f3, #5f6af7);
        color: #fff;
        padding: 1rem 1.5rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        font-weight: 600;
    }

    .chat-badge {
        background: #fff;
        color: #2f39f3;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        border-radius: 1rem;
        padding: 0.3rem 0.8rem;
        font-size: 0.75rem;
    }

    .chat-body {
        max-height: 450px;
        overflow-y: auto;
        background: #f8f9fb;
        padding: 1.2rem 1.5rem;
    }

    .chat-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #eee;
        background: #fff;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .btn-kirim {
        background: #2f39f3;
        color: #fff;
        transition: background 0.3s;
    }

    .btn-kirim:hover {
        background: #1f28d7;
        color: #fff;
    }

    .chat-bubble-user {
        background: #2f39f3;
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        max-width: 70%;
        white-space: pre-wrap;
    }

    .chat-bubble-admin {
        background: #fff;
        color: #333;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border: 1px solid #e2e5ec;
        max-width: 70%;
        white-space: pre-wrap;
    }

    .chat-meta {
        font-size: 10px;
        opacity: 0.7;
        margin-top: 0.4rem;
        text-align: right;
    }
</style>

<div class="container py-3">
    <div class="card chat-card">
        <div class="chat-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-chat-dots-fill me-2"></i>SMKKAMPAY</h5>
            <span class="chat-badge">● Online</span>
        </div>

        <div id="chat-box" class="chat-body">
            @foreach ($chats as $chat)
                @if ($chat->sender_id === Auth::id())
                    <!-- User Message -->
                    <div class="mb-3 d-flex justify-content-end">
                        <div class="chat-bubble-user">
                            <small class="d-block mb-1 fw-bold text-light">Anda:</small>
                            {{ $chat->pesan }}
                            <div class="chat-meta text-light">
                                {{ \Carbon\Carbon::parse($chat->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Admin Message -->
                    <div class="mb-3 d-flex justify-content-start">
                        <div class="chat-bubble-admin">
                            <small class="d-block mb-1 text-muted fw-bold">Admin:</small>
                            {{ $chat->pesan }}
                            <div class="chat-meta text-muted">
                                {{ \Carbon\Carbon::parse($chat->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="chat-footer">
            <form method="POST" action="{{ route('siswa.chat.send') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="pesan" class="form-control rounded-pill shadow-sm border-0 px-3" placeholder="Tulis pesan di sini..." required>
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
