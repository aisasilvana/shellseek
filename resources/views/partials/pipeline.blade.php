@php
    $order = ['recon', 'scanning', 'analysis', 'report'];
    $currentIndex = array_search($conversation->stage ?? 'recon', $order);
@endphp
<div class="pipeline-bar">
    <div class="pipeline-title">Sesi aktif — <span>target: {{ $conversation->target ?? '-' }}</span></div>
    <div class="pipeline">
        @foreach ($order as $i => $key)
            <div class="pstage {{ $i < $currentIndex ? 'done' : ($i === $currentIndex ? 'active' : '') }}">
                <span class="pstage-dot"></span><span class="pstage-label">{{ $key }}</span>
            </div>
            @if (!$loop->last)
                <div class="pline {{ $i < $currentIndex ? 'done' : '' }}"></div>
            @endif
        @endforeach
    </div>
</div>