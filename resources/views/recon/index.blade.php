@extends('layouts.app')

@section('pipeline')
<div class="pipeline-bar">
    <div class="pipeline-title">Modul — <span>Reconnaissance (OSINT username)</span></div>
</div>
@endsection

@section('content')
<div class="view active">
    <div class="dash">
        <div class="dash-head">
            <div class="dash-eyebrow">Reconnaissance · Agent 1</div>
            <div class="dash-title">Pencarian username OSINT</div>
            <div class="dash-desc">Cek keberadaan sebuah username di berbagai platform publik.</div>
        </div>

        <form class="osint-form" action="{{ route('recon.search') }}" method="POST">
            @csrf
            <input type="text" name="username" value="{{ $username }}" placeholder="masukkan username..." required>
            <button class="btn-run" type="submit">Cari &amp; generate report</button>
        </form>

        @if ($results->isNotEmpty())
            @php
                $foundCount = $results->where('found', true)->count();
                $total = $results->count();
            @endphp

            <div class="stat-row">
                <div class="stat-card teal"><div class="stat-num">{{ $foundCount }}</div><div class="stat-label">platform ditemukan</div></div>
                <div class="stat-card"><div class="stat-num">{{ $total }}</div><div class="stat-label">platform dicek</div></div>
            </div>

            <div class="panel">
                <div class="panel-title">Detail temuan<span class="tag">{{ $total }} hasil</span></div>
                <table>
                    <thead><tr><th>Platform</th><th>URL profil</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach ($results as $r)
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
            </div>
        @endif
    </div>
</div>
@endsection