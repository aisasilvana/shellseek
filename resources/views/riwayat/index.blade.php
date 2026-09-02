@extends('layouts.app')

@section('pipeline')
<div class="pipeline-bar">
    <div class="pipeline-title">Modul — <span>Riwayat percakapan</span></div>
    <form action="{{ route('chat.new') }}" method="POST">
        @csrf
        <button type="submit" class="btn-run">+ Chat baru</button>
    </form>
</div>
@endsection

@section('content')
<div class="view active">
    <div class="dash">
        <div class="dash-head">
            <div class="dash-eyebrow">Riwayat</div>
            <div class="dash-title">Semua sesi percakapan</div>
            <div class="dash-desc">Buka kembali sesi lama, atau mulai sesi baru.</div>
        </div>

        <div class="panel">
            @if ($conversations->isNotEmpty())
                <table>
                    <thead><tr><th>Judul</th><th>Target</th><th>Jumlah pesan</th><th>Dibuat</th><th></th></tr></thead>
                    <tbody>
                        @foreach ($conversations as $c)
                            <tr>
                                <td class="strong">{{ $c->title }}</td>
                                <td>{{ $c->target }}</td>
                                <td>{{ $c->messages_count }}</td>
                                <td>{{ $c->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('chat.show', $c) }}" style="color:var(--teal); font-size:12.5px;">Buka →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color:var(--text-muted); font-size:13px;">Belum ada percakapan.</p>
            @endif
        </div>
    </div>
</div>
@endsection