@extends('layouts.app')

@section('title', 'Siswa – ' . $tahunAjaran->nama)

@section('breadcrumb')
  <a href="{{ route('dashboard') }}">Dashboard</a>
  <span>/</span>
  <a href="{{ route('tahun-ajaran.index') }}">Tahun Ajaran</a>
  <span>/</span>
  {{ $tahunAjaran->nama }}
@endsection

@section('content')

@if(session('import_errors'))
  <div style="background:#fee2e2; border:1px solid #fecaca; padding:16px; border-radius:10px; margin-bottom:1rem;">

    <div style="font-weight:700; color:#991b1b; margin-bottom:8px;">
      ⚠ Terjadi kesalahan saat import:
    </div>

    <ul style="font-size:13px; color:#7f1d1d; padding-left:18px;">
      @foreach(session('import_errors') as $error)
        <li style="margin-bottom:6px;">
          <strong>Baris {{ $error['row'] }}</strong>
          ({{ $error['attribute'] }}) :
          {{ implode(', ', $error['errors']) }}
        </li>
      @endforeach
    </ul>

  </div>
@endif

{{-- Info card tahun ajaran --}}
<div style="background:#fff; border-radius:14px; border:1px solid #e2e8e4; padding:1.25rem 1.5rem; margin-bottom:1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
  <div style="display:flex; align-items:center; gap:16px;">
    <div style="width:48px; height:48px; border-radius:12px; background:#d1fae5; display:flex; align-items:center; justify-content:center;">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#065f46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    </div>
    <div>
      <div style="font-size:18px; font-weight:700; color:#111827;">Tahun Ajaran {{ $tahunAjaran->nama }}</div>
      <div style="font-size:12.5px; color:#6b7280; margin-top:2px;">
        Pengumuman:
        {{ \Carbon\Carbon::parse($tahunAjaran->tanggal_mulai_pengumuman)->translatedFormat('d M Y') }}
        &ndash;
        {{ \Carbon\Carbon::parse($tahunAjaran->tanggal_selesai_pengumuman)->translatedFormat('d M Y') }}
      </div>
    </div>
  </div>
  <div style="display:flex; align-items:center; gap:10px;">
    @if ($tahunAjaran->isPengumumanAktif())
      <span class="badge badge-aktif" style="padding:6px 14px; font-size:12px;">● Pengumuman Aktif</span>
    @else
      <span class="badge badge-nonaktif" style="padding:6px 14px; font-size:12px;">Pengumuman Tidak Aktif</span>
    @endif
    <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-ghost btn-sm">← Kembali</a>
  </div>
</div>

{{-- Ringkasan --}}
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(150px,1fr)); gap:12px; margin-bottom:1.5rem;">
  <div style="background:#fff; border-radius:12px; border:1px solid #e2e8e4; padding:1rem 1.25rem;">
    <div style="font-size:11px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Total Siswa</div>
    <div style="font-size:24px; font-weight:700; color:#111827;">{{ $siswas->total() }}</div>
  </div>
  <div style="background:#fff; border-radius:12px; border:1px solid #e2e8e4; padding:1rem 1.25rem;">
    <div style="font-size:11px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Lulus</div>
    <div style="font-size:24px; font-weight:700; color:#065f46;">{{ $totalLulus }}</div>
  </div>
  <div style="background:#fff; border-radius:12px; border:1px solid #e2e8e4; padding:1rem 1.25rem;">
    <div style="font-size:11px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Tidak Lulus</div>
    <div style="font-size:24px; font-weight:700; color:#991b1b;">{{ $totalTidakLulus }}</div>
  </div>
  <div style="background:#fff; border-radius:12px; border:1px solid #e2e8e4; padding:1rem 1.25rem;">
    <div style="font-size:11px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Persentase Lulus</div>
    <div style="font-size:24px; font-weight:700; color:#1a4731;">
      {{ $siswas->total() > 0 ? round(($totalLulus / $siswas->total()) * 100) : 0 }}%
    </div>
  </div>
</div>

{{-- Tabel siswa --}}
<div class="card">
  <div class="card-header">
    <div class="card-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
      </svg>
      Daftar Siswa
    </div>
    <div style="display:flex; gap:8px; align-items:center;">
      {{-- Search --}}
      <button class="btn btn-primary" onclick="bukaModalImport()">
  📥 Import Excel
</button>
      <form method="GET" style="display:flex; gap:6px;">
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Cari nama / NIS..."
          style="padding:7px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:13px; width:200px; outline:none; font-family:inherit;" />
        <button type="submit" class="btn btn-ghost btn-sm">Cari</button>
        @if(request('search'))
          <a href="{{ route('tahun-ajaran.show', $tahunAjaran) }}" class="btn btn-ghost btn-sm">Reset</a>
        @endif
      </form>
      <button class="btn btn-primary" onclick="bukaModalTambahSiswa()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Siswa
      </button>
    </div>
  </div>

  <div class="table-wrap">

    <table>
      <thead>
        <tr>
          <th width="50">#</th>
          <th>NIS</th>
          <th>Nama Lengkap</th>
          <th>Jenis Kelamin</th>
          <th>Kelas</th>
          <th>Status</th>
          <th width="140">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($siswas as $siswa)
          <tr>
            <td style="color:#9ca3af;">{{ $siswas->firstItem() + $loop->index }}</td>
            <td style="font-weight:600; font-family:monospace; font-size:13px;">{{ $siswa->nis }}</td>
            <td style="font-weight:500; color:#111827;">{{ $siswa->nama }}</td>
            <td style="color:#6b7280;">{{ $siswa->jenis_kelamin }}</td>
            <td><span style="background:#f0f4f1; padding:3px 10px; border-radius:6px; font-size:12px; font-weight:600; color:#1a4731;">{{ $siswa->kelas }}</span></td>
            <td>
              @if ($siswa->status === 'Lulus')
                <span class="badge badge-lulus">✓ Lulus</span>
              @else
                <span class="badge badge-tidak">✗ Tidak Lulus</span>
              @endif
            </td>
            <td>
              <div style="display:flex; gap:6px;">
                <button class="btn btn-ghost btn-sm"
                  onclick="bukaModalEditSiswa({{ $siswa->id }}, '{{ $siswa->nis }}', '{{ addslashes($siswa->nama) }}', '{{ $siswa->jenis_kelamin }}', '{{ $siswa->kelas }}', '{{ $siswa->status }}')">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  Edit
                </button>
                <button class="btn btn-danger btn-sm"
                  onclick="bukaModalHapusSiswa({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                  Hapus
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                <p>{{ request('search') ? 'Siswa tidak ditemukan.' : 'Belum ada siswa. Klik Tambah Siswa untuk memulai.' }}</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if ($siswas->hasPages())
  <div class="pagination-wrapper">

    <div class="pagination-info">
      Menampilkan {{ $siswas->firstItem() }}–{{ $siswas->lastItem() }} dari {{ $siswas->total() }} siswa
    </div>

    <div class="pagination-links">
      {{ $siswas->appends(request()->query())->links() }}
    </div>

  </div>
@endif
</div>


{{-- ===================== MODAL TAMBAH SISWA ===================== --}}
<div class="modal-overlay" id="modal-tambah-siswa">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Tambah Siswa</div>
      <button class="modal-close" onclick="tutupModal('modal-tambah-siswa')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" action="{{ route('tahun-ajaran.siswa.store', $tahunAjaran) }}">
      @csrf
      <div class="modal-body">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">NIS <span>*</span></label>
            <input type="text" name="nis" class="form-control" placeholder="contoh: 12345" required value="{{ old('nis') }}" />
            @error('nis') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label class="form-label">Kelas <span>*</span></label>
            <input type="text" name="kelas" class="form-control" placeholder="contoh: IX-A" required value="{{ old('kelas') }}" />
            @error('kelas') <div class="form-error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Nama Lengkap <span>*</span></label>
          <input type="text" name="nama" class="form-control" placeholder="Nama lengkap siswa" required value="{{ old('nama') }}" />
          @error('nama') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Jenis Kelamin <span>*</span></label>
            <select name="jenis_kelamin" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="L"  {{ old('jenis_kelamin') === 'L'  ? 'selected' : '' }}>Laki-laki</option>
              <option value="P"  {{ old('jenis_kelamin') === 'P'  ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label class="form-label">Status <span>*</span></label>
            <select name="status" class="form-control" required>
              <option value="Lulus"       {{ old('status') === 'Lulus'       ? 'selected' : '' }}>Lulus</option>
              <option value="Tidak Lulus" {{ old('status') === 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
            @error('status') <div class="form-error">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-tambah-siswa')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===================== MODAL EDIT SISWA ===================== --}}
<div class="modal-overlay" id="modal-edit-siswa">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Siswa</div>
      <button class="modal-close" onclick="tutupModal('modal-edit-siswa')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" id="form-edit-siswa">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">NIS <span>*</span></label>
            <input type="text" name="nis" id="es-nis" class="form-control" required />
          </div>
          <div class="form-group">
            <label class="form-label">Kelas <span>*</span></label>
            <input type="text" name="kelas" id="es-kelas" class="form-control" required />
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Nama Lengkap <span>*</span></label>
          <input type="text" name="nama" id="es-nama" class="form-control" required />
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Jenis Kelamin <span>*</span></label>
            <select name="jenis_kelamin" id="es-jk" class="form-control" required>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Status <span>*</span></label>
            <select name="status" id="es-status" class="form-control" required>
              <option value="Lulus">Lulus</option>
              <option value="Tidak Lulus">Tidak Lulus</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-edit-siswa')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===================== MODAL HAPUS SISWA ===================== --}}
<div class="modal-overlay" id="modal-hapus-siswa">
  <div class="modal" style="max-width:400px;">
    <div class="modal-body" style="text-align:center; padding:2rem;">
      <div class="confirm-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
      </div>
      <div style="font-size:16px; font-weight:700; color:#111827; margin-bottom:8px;">Hapus Data Siswa?</div>
      <div style="font-size:13px; color:#6b7280; margin-bottom:1.5rem;">
        Data siswa <strong id="hapus-nama-siswa"></strong> akan dihapus permanen.
      </div>
      <form method="POST" id="form-hapus-siswa">
        @csrf
        @method('DELETE')
        <div style="display:flex; gap:8px; justify-content:center;">
          <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-hapus-siswa')">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ===================== MODAL IMPORT EXCEL ===================== --}}
<div class="modal-overlay" id="modal-import-excel">
  <div class="modal" style="max-width:420px;">

    <div class="modal-header">
      <div class="modal-title">Import Data Siswa</div>
      <button class="modal-close" onclick="tutupModal('modal-import-excel')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <form action="{{ route('tahun-ajaran.siswa.import', $tahunAjaran) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="modal-body">

        {{-- Unduh Template --}}
        <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 12px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; margin-bottom:16px;">
          <div style="display:flex; align-items:center; gap:8px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" style="width:18px; height:18px; flex-shrink:0;">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="12" y1="11" x2="12" y2="17"/>
              <polyline points="9 14 12 17 15 14"/>
            </svg>
            <span style="font-size:13px; color:#15803d; font-weight:500;">Template Excel</span>
          </div>
          <a href="{{ asset('template/daftar-siswa.xlsx') }}" download
            style="font-size:12px; color:#16a34a; font-weight:600; text-decoration:none; padding:5px 12px; border:1px solid #16a34a; border-radius:6px; transition:all .2s;"
            onmouseover="this.style.background='#16a34a'; this.style.color='#fff';"
            onmouseout="this.style.background='transparent'; this.style.color='#16a34a';">
            Unduh
          </a>
        </div>

        {{-- Panduan Format --}}
        <div style="padding:10px 12px; background:#fffbeb; border:1px solid #fde68a; border-radius:8px; margin-bottom:16px;">
          <div style="font-size:12px; font-weight:600; color:#92400e; margin-bottom:6px;">⚠️ Panduan Format</div>
          <ul style="margin:0; padding-left:16px; font-size:12px; color:#78350f; line-height:1.8;">
            <li><strong>NIS</strong> — tidak boleh sama antar siswa</li>
            <li><strong>Jenis Kelamin</strong> — <code style="background:#fef3c7; padding:1px 5px; border-radius:4px;">L</code> atau <code style="background:#fef3c7; padding:1px 5px; border-radius:4px;">P</code></li>
            <li><strong>Status</strong> — <code style="background:#fef3c7; padding:1px 5px; border-radius:4px;">Lulus</code> atau <code style="background:#fef3c7; padding:1px 5px; border-radius:4px;">Tidak Lulus</code></li>
          </ul>
        </div>

        <div class="form-group">
          <label class="form-label">Upload File Excel <span>*</span></label>

          <input type="file" name="file" accept=".xlsx,.xls,.csv" required
            style="width:100%; padding:10px; border:1px solid #d1d5db; border-radius:8px; font-size:13px;" />

          <div style="font-size:11px; color:#6b7280; margin-top:6px;">
            Format kolom: <strong>nis, nama, jenis_kelamin, kelas, status</strong>
          </div>

          @error('file')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-import-excel')">Batal</button>
        <button type="submit" class="btn btn-primary">Upload & Import</button>
      </div>
    </form>

  </div>
</div>

@endsection

@section('scripts')
<script>
function bukaModal(id)  { document.getElementById(id).classList.add('show'); }
function tutupModal(id) { document.getElementById(id).classList.remove('show'); }

function bukaModalTambahSiswa() { bukaModal('modal-tambah-siswa'); }

function bukaModalImport() {
  bukaModal('modal-import-excel');
}

function bukaModalEditSiswa(id, nis, nama, jk, kelas, status) {
  document.getElementById('form-edit-siswa').action = `/tahun-ajaran/{{ $tahunAjaran->id }}/siswa/${id}`;
  document.getElementById('es-nis').value    = nis;
  document.getElementById('es-nama').value   = nama;
  document.getElementById('es-kelas').value  = kelas;
  document.getElementById('es-jk').value     = jk;
  document.getElementById('es-status').value = status;
  bukaModal('modal-edit-siswa');
}

function bukaModalHapusSiswa(id, nama) {
  document.getElementById('form-hapus-siswa').action = `/tahun-ajaran/{{ $tahunAjaran->id }}/siswa/${id}`;
  document.getElementById('hapus-nama-siswa').textContent = nama;
  bukaModal('modal-hapus-siswa');
}

// Buka modal tambah otomatis jika ada error validasi
@if ($errors->any())
  bukaModalTambahSiswa();
@endif

// Tutup modal klik di luar
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('show');
  });
});
</script>
@endsection
