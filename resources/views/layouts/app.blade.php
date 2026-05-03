<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'Dashboard') – Nama Sekolah Anda</title>
<link rel="icon" type="image/png" href="{{asset('img/logo_sekolah.png')}}">
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --hijau-tua:   #1a4731;
  --hijau-mid:   #1f5c3e;
  --hijau-aksen: #2d7a55;
  --hijau-muda:  #4caf78;
  --emas:        #d4a017;
  --emas-light:  #f0c84a;
  --putih:       #ffffff;
  --sidebar-w:   240px;
}

body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: #f0f4f1;
  min-height: 100vh;
  display: flex;
}

/* ===================== SIDEBAR ===================== */
.sidebar {
  width: var(--sidebar-w);
  background: var(--hijau-tua);
  min-height: 100vh;
  position: fixed; top: 0; left: 0; bottom: 0;
  display: flex; flex-direction: column;
  z-index: 40;
  border-right: 1px solid rgba(212,160,23,0.2);
}

/* Strip emas atas sidebar */
.sidebar::before {
  content: '';
  display: block; height: 4px;
  background: linear-gradient(90deg, var(--emas), var(--emas-light), var(--hijau-muda), var(--emas-light), var(--emas));
  background-size: 300%;
  animation: geser 4s linear infinite;
  flex-shrink: 0;
}

@keyframes geser {
  0%   { background-position: 0% 50%; }
  100% { background-position: 200% 50%; }
}

.sidebar-brand {
  padding: 1.25rem 1.25rem 1rem;
  border-bottom: 1px solid rgba(212,160,23,0.15);
  display: flex; align-items: center; gap: 10px;
}

.brand-logo {
  width: 40px; height: 40px; border-radius: 50%;
  background: #f3f3f3;
  border: 1px solid rgba(212,160,23,0.4);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.brand-logo img { width: 24px; height: 24px; }

.brand-text { overflow: hidden; }
.brand-label {
  font-size: 8.5px; font-weight: 700; letter-spacing: 2px;
  text-transform: uppercase; color: var(--emas); margin-bottom: 1px;
  white-space: nowrap;
}
.brand-name {
  font-family: 'Amiri', serif; font-size: 14px; font-weight: 700;
  color: var(--putih); line-height: 1.2; white-space: nowrap;
}

/* Nav menu */
.sidebar-nav { padding: 1rem 0.75rem; flex: 1; }

.nav-label {
  font-size: 9px; font-weight: 700; letter-spacing: 2.5px;
  text-transform: uppercase; color: rgba(255,255,255,0.28);
  padding: 0 0.5rem; margin-bottom: 6px; margin-top: 1rem;
}
.nav-label:first-child { margin-top: 0; }

.nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px; border-radius: 10px;
  color: rgba(255,255,255,0.55); font-size: 13px; font-weight: 500;
  text-decoration: none; transition: background 0.15s, color 0.15s;
  margin-bottom: 2px;
}
.nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.9); }
.nav-item.active {
  background: rgba(212,160,23,0.15);
  color: var(--emas-light);
  border: 1px solid rgba(212,160,23,0.25);
}
.nav-item svg { width: 17px; height: 17px; flex-shrink: 0; }

/* User card di bawah */
.sidebar-user {
  padding: 1rem 1.25rem;
  border-top: 1px solid rgba(212,160,23,0.15);
}
.user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
.user-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: rgba(212,160,23,0.18);
  border: 1px solid rgba(212,160,23,0.35);
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700; color: var(--emas-light);
  flex-shrink: 0;
}
.user-name { font-size: 12.5px; font-weight: 600; color: var(--putih); }
.user-role { font-size: 10px; color: rgba(255,255,255,0.35); margin-top: 1px; }

.btn-logout {
  width: 100%; padding: 8px;
  background: rgba(220,38,38,0.1);
  border: 1px solid rgba(220,38,38,0.25);
  border-radius: 8px; color: #fca5a5;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 12px; font-weight: 600; cursor: pointer;
  display: flex; align-items: center; justify-content: center; gap: 7px;
  transition: background 0.15s;
  text-decoration: none;
}
.btn-logout:hover { background: rgba(220,38,38,0.2); }
.btn-logout svg { width: 14px; height: 14px; }

/* ===================== MAIN CONTENT ===================== */
.main {
  margin-left: var(--sidebar-w);
  flex: 1; min-height: 100vh;
  display: flex; flex-direction: column;
}

/* Topbar */
.topbar {
  background: var(--putih);
  border-bottom: 1px solid #e2e8e4;
  padding: 0 2rem;
  height: 60px;
  display: flex; align-items: center; justify-content: space-between;
  position: sticky; top: 0; z-index: 30;
}

.topbar-left { display: flex; align-items: center; gap: 10px; }

.breadcrumb {
  display: flex; align-items: center; gap: 6px;
  font-size: 13px; color: #6b7280;
}
.breadcrumb a { color: var(--hijau-aksen); text-decoration: none; font-weight: 500; }
.breadcrumb a:hover { text-decoration: underline; }
.breadcrumb span { color: #9ca3af; }

.page-title {
  font-size: 15px; font-weight: 700; color: var(--hijau-tua);
}

.topbar-right { display: flex; align-items: center; gap: 12px; }

.topbar-date {
  font-size: 11.5px; color: #9ca3af;
  background: #f3f4f6; padding: 5px 12px;
  border-radius: 20px; font-weight: 500;
}

/* Alert flash */
.alert {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; border-radius: 10px; font-size: 13px;
  margin-bottom: 1.5rem; font-weight: 500;
}
.alert-success {
  background: #d1fae5; border: 1px solid #6ee7b7; color: #065f46;
}
.alert-error {
  background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b;
}
.alert svg { width: 16px; height: 16px; flex-shrink: 0; }

/* Content area */
.content { padding: 2rem; flex: 1; }

/* ===================== CARD ===================== */
.card {
  background: var(--putih);
  border-radius: 14px;
  border: 1px solid #e2e8e4;
  overflow: hidden;
}

.card-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid #e2e8e4;
  display: flex; align-items: center; justify-content: space-between;
  background: #fafbfa;
}

.card-title {
  font-size: 15px; font-weight: 700; color: var(--hijau-tua);
  display: flex; align-items: center; gap: 8px;
}
.card-title svg { width: 18px; height: 18px; color: var(--hijau-aksen); }

.card-body { padding: 1.5rem; }

/* ===================== TOMBOL ===================== */
.btn {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 8px 16px; border-radius: 8px; font-size: 13px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-weight: 600; cursor: pointer; border: none;
  text-decoration: none; transition: opacity 0.15s, transform 0.1s;
}
.btn:hover { opacity: 0.88; }
.btn:active { transform: scale(0.97); }
.btn svg { width: 15px; height: 15px; }

.btn-primary { background: var(--hijau-aksen); color: var(--putih); }
.btn-emas    { background: var(--emas); color: #2a1800; }
.btn-danger  { background: #dc2626; color: var(--putih); }
.btn-ghost   {
  background: transparent; color: var(--hijau-aksen);
  border: 1px solid var(--hijau-aksen);
}
.btn-sm { padding: 5px 11px; font-size: 12px; }

/* ===================== TABLE ===================== */
.table-wrap { overflow-x: auto; }

table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
thead tr { background: #f0f7f3; }
th {
  padding: 11px 14px; text-align: left; font-size: 11px;
  font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
  color: var(--hijau-aksen); white-space: nowrap;
  border-bottom: 1px solid #e2e8e4;
}
td {
  padding: 12px 14px; color: #374151;
  border-bottom: 1px solid #f3f4f6; vertical-align: middle;
}
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover { background: #f9fafb; }

/* Badge */
.badge {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700;
}
.badge-lulus   { background: #d1fae5; color: #065f46; }
.badge-tidak   { background: #fee2e2; color: #991b1b; }
.badge-aktif   { background: #d1fae5; color: #065f46; }
.badge-nonaktif{ background: #f3f4f6; color: #6b7280; }

/* Empty state */
.empty-state {
  text-align: center; padding: 3rem 1rem;
  color: #9ca3af;
}
.empty-state svg { width: 48px; height: 48px; margin: 0 auto 1rem; opacity: 0.35; display: block; }
.empty-state p { font-size: 14px; }

/* ===================== MODAL ===================== */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.5);
  backdrop-filter: blur(3px);
  display: flex; align-items: center; justify-content: center;
  z-index: 200; opacity: 0; pointer-events: none; transition: opacity 0.25s;
}
.modal-overlay.show { opacity: 1; pointer-events: all; }

.modal {
  background: var(--putih); border-radius: 16px;
  width: 480px; max-width: 95vw; max-height: 90vh; overflow-y: auto;
  transform: scale(0.92) translateY(20px); opacity: 0;
  transition: transform 0.3s cubic-bezier(.34,1.4,.64,1), opacity 0.25s;
  box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}
.modal-overlay.show .modal { transform: scale(1) translateY(0); opacity: 1; }

.modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid #e2e8e4;
  display: flex; align-items: center; justify-content: space-between;
}
.modal-title { font-size: 15px; font-weight: 700; color: var(--hijau-tua); }

.modal-close {
  background: none; border: none; cursor: pointer;
  color: #9ca3af; padding: 4px;
  border-radius: 6px; display: flex; transition: background 0.15s;
}
.modal-close:hover { background: #f3f4f6; color: #374151; }
.modal-close svg { width: 18px; height: 18px; }

.modal-body { padding: 1.5rem; }
.modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid #e2e8e4;
  display: flex; justify-content: flex-end; gap: 8px;
}

/* Form elemen di modal */
.form-group { margin-bottom: 1.1rem; }
.form-label {
  display: block; font-size: 11.5px; font-weight: 600;
  color: #374151; margin-bottom: 6px; letter-spacing: 0.3px;
}
.form-label span { color: #dc2626; }

.form-control {
  width: 100%; padding: 10px 13px;
  border: 1px solid #d1d5db; border-radius: 8px;
  font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
  color: #111827; outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control:focus {
  border-color: var(--hijau-aksen);
  box-shadow: 0 0 0 3px rgba(45,122,85,0.12);
}
.form-control::placeholder { color: #9ca3af; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

.form-error { font-size: 11.5px; color: #dc2626; margin-top: 4px; }

/* Konfirmasi hapus */
.confirm-icon {
  width: 56px; height: 56px; border-radius: 50%;
  background: #fee2e2; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1rem;
}
.confirm-icon svg { width: 26px; height: 26px; color: #dc2626; }

/* Footer */
.page-footer {
  padding: 1rem 2rem; border-top: 1px solid #e2e8e4;
  font-size: 11px; color: #9ca3af; text-align: center;
  background: var(--putih);
}

.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border-top: 1px solid #e5e7eb;
}

.pagination-info {
    font-size: 13px;
    color: #6b7280;
}

.pagination-links {
    display: flex;
    align-items: center;
}

.pagination-links nav {
    display: flex;
    align-items: center;
}

.pagination-links p {
    display: none;
}

.pagination-links nav > div {
    display: flex;
    align-items: center;
    gap: 6px;
}

.pagination-links a,
.pagination-links span {
    display: inline-flex;          /* ← fix: contain SVG inside button */
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 6px;
    text-decoration: none;
    border: 1px solid #e5e7eb;
    min-width: 32px;
    height: 32px;
}

/* ← KEY FIX: constrain the SVG arrow icons */
.pagination-links a svg,
.pagination-links span svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
}

.pagination-links a {
    background: #ffffff;
    color: #374151;
}

.pagination-links a:hover {
    background: #f3f4f6;
}

.pagination-links span[aria-current="page"] {
    background: #10b981;
    color: #ffffff;
    font-weight: 600;
    border-color: #10b981;
}

.pagination-links span {
    color: #9ca3af;
    background: #f9fafb;
}



</style>
@yield('head')
@yield('styles')
</head>
<body>

<!-- ==================== SIDEBAR ==================== -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-logo">
      <img src="{{asset('img/logo_sekolah.png')}}" alt="" srcset="">
    </div>
    <div class="brand-text">
      <div class="brand-label">Kemenag RI</div>
      <div class="brand-name">Nama Sekolah Anda</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Menu</div>
    <a href="{{ route('dashboard') }}"
       class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
      </svg>
      Dashboard
    </a>

    <a href="{{ route('tahun-ajaran.index') }}"
       class="nav-item {{ request()->routeIs('tahun-ajaran.*') ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      Tahun Ajaran
    </a>
  </nav>

  <div class="sidebar-user">
    <div class="user-info">
      <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
      <div>
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-role">Administrator</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Keluar
      </button>
    </form>
  </div>
</aside>

<!-- ==================== MAIN ==================== -->
<div class="main">

  <!-- Topbar -->
  <div class="topbar">
    <div class="topbar-left">
      <div>
        <div class="breadcrumb">@yield('breadcrumb')</div>
        <div class="page-title">@yield('title', 'Dashboard')</div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="topbar-date" id="tgl-sekarang"></div>
    </div>
  </div>

  <!-- Content -->
  <div class="content">

    {{-- Flash message --}}
    @if (session('success'))
      <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
      </div>
    @endif

    @yield('content')
  </div>

  <div class="page-footer">
    Nama Sekolah Anda &middot; Kementerian Agama RI &middot; Kabupaten Jember
  </div>
</div>

<script>
// Tanggal di topbar
const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
const d = new Date();
document.getElementById('tgl-sekarang').textContent =
  hari[d.getDay()] + ', ' + d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
</script>

@yield('scripts')
</body>
</html>
