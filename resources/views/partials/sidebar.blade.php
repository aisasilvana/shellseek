<div class="sidebar">
  <div class="brand">
    <div class="brand-mark"><span class="dot"></span>ShellSeek</div>
    <div class="brand-sub">agentic pentest assistant</div>
  </div>
  <div class="nav">
    <div class="nav-label">Assistant</div>
    <a href="{{ route('chat.index') }}" class="nav-item {{ request()->routeIs('chat.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
      Chat
    </a>
    <a href="{{ route('recon.index') }}" class="nav-item {{ request()->routeIs('recon.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
      Reconnaissance
    </a>
    <a href="{{ route('scan.index') }}" class="nav-item {{ request()->routeIs('scan.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
      Scanning
    </a>
    <a href="{{ route('vulnerability.index') }}" class="nav-item {{ request()->routeIs('vulnerability.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
      Vulnerability
    </a>

    <div class="nav-label">Laporan</div>
    <a href="{{ route('report.index') }}" class="nav-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
      Report
    </a>
    <a href="{{ route('riwayat.index') }}" class="nav-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
      Riwayat
    </a>
  </div>
  <div class="sidebar-footer" style="display:flex; align-items:center; gap:10px;">
    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
    <div class="user-meta" style="flex:1; min-width:0;">
      <div class="user-name">{{ auth()->user()->name }}</div>
      <div class="user-role">Pentester</div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" title="Logout" style="background:none; border:none; color:var(--text-muted); cursor:pointer; padding:6px; display:flex;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </button>
    </form>
  </div>
</div>