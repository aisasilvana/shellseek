@extends('layouts.app')

@section('pipeline')
<div class="pipeline-bar">
    <div class="pipeline-title">Modul — <span>Report (ringkasan temuan)</span></div>
</div>
@endsection

@section('content')
<div class="view active">
    <div class="dash">
        <div class="dash-head">
            <div class="dash-eyebrow">Report · Ringkasan</div>
            <div class="dash-title">Laporan hasil pentest</div>
            <div class="dash-desc">Rangkuman temuan dari Reconnaissance dan Scanning.</div>
        </div>

        <div class="stat-row">
            <div class="stat-card teal">
                <div class="stat-num">{{ $reconResults->where('found', true)->count() }}</div>
                <div class="stat-label">akun ditemukan (username: {{ $username ?? '-' }})</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-num">{{ $scanResults->count() }}</div>
                <div class="stat-label">port terbuka (target: {{ $target ?? '-' }})</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title">Reconnaissance<span class="tag">{{ $reconResults->count() }} platform dicek</span></div>

            @if ($reconResults->isNotEmpty())
                <table>
                    <thead><tr><th>Platform</th><th>URL profil</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach ($reconResults as $r)
                            <tr>
                                <td class="strong">{{ $r->platform }}</td>
                                <td>{{ $r->profile_url ?? '—' }}</td>
                                <td>
                                    @if ($r->found)
                                        <span class="pill found">● ditemukan</span>
                                    @else
                                        <span class="pill notfound">tidak ditemukan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color:var(--text-muted); font-size:13px;">Belum ada data reconnaissance.</p>
            @endif
        </div>

        <div class="panel">
            <div class="panel-title">Scanning<span class="tag">{{ $scanResults->count() }} port ditemukan</span></div>

            @if ($scanResults->isNotEmpty())
                <table>
                    <thead><tr><th>Port</th><th>Service</th><th>Versi</th></tr></thead>
                    <tbody>
                        @foreach ($scanResults as $r)
                            <tr>
                                <td class="strong">{{ $r->port }}</td>
                                <td>{{ $r->service }}</td>
                                <td>{{ $r->version ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color:var(--text-muted); font-size:13px;">Belum ada data scanning.</p>
            @endif
        </div>
    </div>
</div>
@endsection