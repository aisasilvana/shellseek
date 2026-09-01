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

    <div class="nav-label">Laporan</div>
    <a href="{{ route('report.index') }}" class="nav-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>
      Report
    </a>
  </div>
  <div class="sidebar-footer">
    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
    <div class="user-meta">
      <div class="user-name">{{ auth()->user()->name }}</div>
      <div class="user-role">Pentester</div>
    </div>
  </div>
</div>