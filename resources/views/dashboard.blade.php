@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
  Dashboard
@endsection

@section('content')

<style>
.stat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-bottom: 2rem;
}

.stat-card {
  background: #fff;
  border-radius: 14px;
  border: 1px solid #e2e8e4;
  padding: 1.25rem 1.5rem;
  display: flex; align-items: center; gap: 14px;
}

.stat-icon {
  width: 46px; height: 46px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.stat-icon svg { width: 22px; height: 22px; }
.stat-icon.hijau { background: #d1fae5; color: #065f46; }
.stat-icon.emas  { background: #fef3c7; color: #92400e; }
.stat-icon.biru  { background: #dbeafe; color: #1e40af; }
.stat-icon.merah { background: #fee2e2; color: #991b1b; }

.stat-value { font-size: 26px; font-weight: 700; color: #111827; line-height: 1; margin-bottom: 3px; }
.stat-label { font-size: 12px; color: #6b7280; font-weight: 500; }

.welcome-banner {
  background: linear-gradient(135deg, #1a4731, #2d7a55);
  border-radius: 14px; padding: 1.75rem 2rem;
  margin-bottom: 2rem; color: #fff;
  display: flex; align-items: center; justify-content: space-between;
  position: relative; overflow: hidden;
}
.welcome-banner::before {
  content: '✦';
  position: absolute; right: 5rem; top: 1rem;
  font-size: 60px; color: rgba(212,160,23,0.1); pointer-events: none;
}
.welcome-banner::after {
  content: '✦';
  position: absolute; right: 2rem; bottom: -0.5rem;
  font-size: 40px; color: rgba(212,160,23,0.08); pointer-events: none;
}
.welcome-text h2 {
  font-family: 'Amiri', serif; font-size: 20px; margin-bottom: 4px;
}
.welcome-text p { font-size: 13px; color: rgba(255,255,255,0.6); }
.welcome-badge {
  background: rgba(212,160,23,0.2); border: 1px solid rgba(212,160,23,0.4);
  border-radius: 10px; padding: 0.75rem 1.25rem; text-align: center;
  flex-shrink: 0;
}
.welcome-badge .angka { font-family: 'Amiri', serif; font-size: 26px; font-weight: 700; color: #f0c84a; }
.welcome-badge .keterangan { font-size: 10px; color: rgba(255,255,255,0.5); letter-spacing: 1px; text-transform: uppercase; }
</style>

{{-- Welcome banner --}}
<div class="welcome-banner">
  <div class="welcome-text">
    <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>
    <p>Portal Admin Pengumuman Kelulusan Nama Sekolah Anda</p>
  </div>
  @if ($tahunAktif)
    <div class="welcome-badge">
      <div class="angka">{{ $tahunAktif->nama }}</div>
      <div class="keterangan">Tahun Aktif</div>
    </div>
  @endif
</div>

{{-- Statistik --}}
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon hijau">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
    </div>
    <div>
      <div class="stat-value">{{ $totalTahunAjaran }}</div>
      <div class="stat-label">Total Tahun Ajaran</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon emas">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
    </div>
    <div>
      <div class="stat-value">{{ $totalSiswa }}</div>
      <div class="stat-label">Total Siswa</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon biru">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>
    <div>
      <div class="stat-value">{{ $totalLulus }}</div>
      <div class="stat-label">Siswa Lulus</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon merah">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </div>
    <div>
      <div class="stat-value">{{ $totalTidakLulus }}</div>
      <div class="stat-label">Belum Lulus</div>
    </div>
  </div>
</div>

{{-- Tabel tahun ajaran ringkas --}}
<div class="card">
  <div class="card-header">
    <div class="card-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      Tahun Ajaran Terbaru
    </div>
    <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-ghost btn-sm">
      Lihat Semua
    </a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Tahun Ajaran</th>
          <th>Periode Pengumuman</th>
          <th>Jumlah Siswa</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tahunAjaranList as $ta)
          <tr>
            <td style="font-weight:600; color:#111827;">{{ $ta->nama }}</td>
            <td style="color:#6b7280; font-size:12.5px;">
              {{ \Carbon\Carbon::parse($ta->tanggal_mulai_pengumuman)->translatedFormat('d M Y') }}
              &ndash;
              {{ \Carbon\Carbon::parse($ta->tanggal_selesai_pengumuman)->translatedFormat('d M Y') }}
            </td>
            <td>{{ $ta->siswas_count }} siswa</td>
            <td>
              @if ($ta->isPengumumanAktif())
                <span class="badge badge-aktif">● Aktif</span>
              @else
                <span class="badge badge-nonaktif">Tidak Aktif</span>
              @endif
            </td>
            <td>
              <a href="{{ route('tahun-ajaran.show', $ta) }}" class="btn btn-ghost btn-sm">Detail</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">
              <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p>Belum ada data tahun ajaran.</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
