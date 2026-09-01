@extends('layouts.app')

@section('pipeline')
    @include('partials.pipeline')
@endsection

@section('content')
<div class="view active">
    <div class="chat-scroll" id="chatScroll">
        @forelse ($messages as $msg)

            @if ($msg->type === 'text')
                <div class="msg-row {{ $msg->role }}">
                    <div class="bubble">
                        @if ($msg->role === 'assistant')
                            <div class="assistant-tag"><span class="dot"></span>{{ $msg->agent ?? 'assistant' }}</div>
                        @endif
                        {{ $msg->content }}
                    </div>
                </div>

            @elseif ($msg->type === 'command_suggestion')
                @if ($msg->content)
                    <div class="msg-row assistant">
                        <div class="bubble">
                            <div class="assistant-tag"><span class="dot"></span>{{ $msg->agent ?? 'assistant' }}</div>
                            {{ $msg->content }}
                        </div>
                    </div>
                @endif

                <div class="cmd-card">
                    <div class="cmd-card-eyebrow">
                        @if ($msg->status === 'pending')
                            ⚠ perlu konfirmasi sebelum eksekusi
                        @elseif ($msg->status === 'cancelled')
                            ✕ dibatalkan oleh user
                        @else
                            ✓ sudah dieksekusi
                        @endif
                    </div>
                    <div class="cmd-code">{{ $msg->command_text }}</div>

                    @if ($msg->status === 'pending')
                        <div class="cmd-actions">
                            <form action="{{ route('chat.execute', $msg) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">Eksekusi</button>
                            </form>
                            <form action="{{ route('chat.cancel', $msg) }}" method="POST">
                                @csrf
                                <button class="btn btn-ghost" type="submit">Batal</button>
                            </form>
                        </div>
                    @endif

                    @if ($msg->status === 'executed' && $msg->execution_output)
                        <div class="result-card" style="display:block; margin-left:0; max-width:none;">
                            <pre style="white-space:pre-wrap; margin:0;">{{ $msg->execution_output }}</pre>
                        </div>
                    @endif
                </div>
            @endif

        @empty
            <div class="msg-row assistant">
                <div class=bubble">
                    <div class="assistant-tag"><span class="dot"></span>assistant</div>
                    Halo, mau dibantu apa hari ini? Tanya saja pakai bahasa biasa.
                </div>
            </div>
        @endforelse
    </div>

    <form class="composer" action="{{ route('chat.send', $conversation) }}" method="POST">
        @csrf
        <div class="composer-inner">
            <input type="text" name="message" placeholder="Tanya apa saja, misalnya: cek port terbuka di target ini..." required autocomplete="off">
            <button class="send-btn" type="submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4z"/></svg>
            </button>
        </div>
        <div class="composer-hint">ShellSeek menyarankan command — setiap eksekusi tetap butuh konfirmasi kamu.</div>
    </form>
</div>

<script>
    const chatScroll = document.getElementById('chatScroll');
    if (chatScroll) chatScroll.scrollTop = chatScroll.scrollHeight;
</script>
@endsection