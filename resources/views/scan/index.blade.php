@extends('layouts.app')

@section('pipeline')
<div class="pipeline-bar">
    <div class="pipeline-title">Modul — <span>Scanning (port &amp; service)</span></div>
</div>
@endsection

@section('content')
<div class="view active">
    <div class="dash">
        <div class="dash-head">
            <div class="dash-eyebrow">Scanning · Agent 2</div>
            <div class="dash-title">Scan port &amp; service</div>
            <div class="dash-desc">Cek port terbuka dan service yang jalan di sebuah target.</div>
        </div>

        <form class="osint-form" action="{{ route('scan.run') }}" method="POST">
            @csrf
            <input type="text" name="target" value="{{ $target }}" placeholder="masukkan target, misal latihan-lab.local" required>
            <button class="btn-run" type="submit">Jalankan scan</button>
        </form>

        @if ($results->isNotEmpty())
            <div class="stat-row">
                <div class="stat-card teal"><div class="stat-num">{{ $results->count() }}</div><div class="stat-label">port terbuka</div></div>
                <div class="stat-card"><div class="stat-num">{{ $target }}</div><div class="stat-label">target</div></div>
            </div>

            <div class="panel">
                <div class="panel-title">Detail port<span class="tag">{{ $results->count() }} hasil</span></div>
                <table>
                    <thead><tr><th>Port</th><th>Service</th><th>Versi</th></tr></thead>
                    <tbody>
                        @foreach ($results as $r)
                            <tr>
                                <td class="strong">{{ $r->port }}</td>
                                <td>{{ $r->service }}</td>
                                <td>{{ $r->version ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection