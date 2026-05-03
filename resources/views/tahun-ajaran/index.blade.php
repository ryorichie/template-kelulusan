@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('breadcrumb')
  <a href="{{ route('dashboard') }}">Dashboard</a>
  <span>/</span> Tahun Ajaran
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <div class="card-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      Daftar Tahun Ajaran
    </div>
    <button class="btn btn-primary" onclick="bukaModalTambah()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Tambah Tahun Ajaran
    </button>
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th width="50">#</th>
          <th>Tahun Ajaran</th>
          <th>Mulai Pengumuman</th>
          <th>Selesai Pengumuman</th>
          <th>Jumlah Siswa</th>
          <th>Status</th>
          <th width="180">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tahunAjarans as $ta)
          <tr>
            <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
            <td style="font-weight:600; color:#111827;">{{ $ta->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($ta->tanggal_mulai_pengumuman)->translatedFormat('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($ta->tanggal_selesai_pengumuman)->translatedFormat('d M Y') }}</td>
            <td>
              <span style="font-weight:600;">{{ $ta->siswas_count }}</span>
              <span style="color:#9ca3af; font-size:12px;"> siswa</span>
            </td>
            <td>
              @if ($ta->isPengumumanAktif())
                <span class="badge badge-aktif">● Aktif</span>
              @else
                <span class="badge badge-nonaktif">Tidak Aktif</span>
              @endif
            </td>
            <td>
              <div style="display:flex; gap:6px;">
                {{-- Lihat siswa --}}
                <a href="{{ route('tahun-ajaran.show', $ta) }}" class="btn btn-emas btn-sm">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                  Siswa
                </a>
                {{-- Edit --}}
                <button class="btn btn-ghost btn-sm"
                  onclick="bukaModalEdit({{ $ta->id }}, '{{ $ta->nama }}', '{{ $ta->tanggal_mulai_pengumuman }}', '{{ $ta->tanggal_selesai_pengumuman }}')">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  Edit
                </button>
                {{-- Hapus --}}
                <button class="btn btn-danger btn-sm"
                  onclick="bukaModalHapus({{ $ta->id }}, '{{ $ta->nama }}')">
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p>Belum ada data tahun ajaran. Klik <strong>Tambah Tahun Ajaran</strong> untuk memulai.</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ===================== MODAL TAMBAH ===================== --}}
<div class="modal-overlay" id="modal-tambah">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Tambah Tahun Ajaran</div>
      <button class="modal-close" onclick="tutupModal('modal-tambah')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" action="{{ route('tahun-ajaran.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Nama Tahun Ajaran <span>*</span></label>
          <input type="text" name="nama" class="form-control"
            placeholder="contoh: 2024/2025" required value="{{ old('nama') }}" />
          @error('nama') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Mulai Pengumuman <span>*</span></label>
            <input type="date" name="tanggal_mulai_pengumuman" class="form-control" required value="{{ old('tanggal_mulai_pengumuman') }}" />
            @error('tanggal_mulai_pengumuman') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label class="form-label">Selesai Pengumuman <span>*</span></label>
            <input type="date" name="tanggal_selesai_pengumuman" class="form-control" required value="{{ old('tanggal_selesai_pengumuman') }}" />
            @error('tanggal_selesai_pengumuman') <div class="form-error">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-tambah')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===================== MODAL EDIT ===================== --}}
<div class="modal-overlay" id="modal-edit">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Tahun Ajaran</div>
      <button class="modal-close" onclick="tutupModal('modal-edit')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" id="form-edit">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Nama Tahun Ajaran <span>*</span></label>
          <input type="text" name="nama" id="edit-nama" class="form-control" required />
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Mulai Pengumuman <span>*</span></label>
            <input type="date" name="tanggal_mulai_pengumuman" id="edit-mulai" class="form-control" required />
          </div>
          <div class="form-group">
            <label class="form-label">Selesai Pengumuman <span>*</span></label>
            <input type="date" name="tanggal_selesai_pengumuman" id="edit-selesai" class="form-control" required />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-edit')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

{{-- ===================== MODAL HAPUS ===================== --}}
<div class="modal-overlay" id="modal-hapus">
  <div class="modal" style="max-width:400px;">
    <div class="modal-body" style="text-align:center; padding:2rem;">
      <div class="confirm-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
      </div>
      <div style="font-size:16px; font-weight:700; color:#111827; margin-bottom:8px;">Hapus Tahun Ajaran?</div>
      <div style="font-size:13px; color:#6b7280; margin-bottom:1.5rem;">
        Tahun ajaran <strong id="hapus-nama"></strong> dan seluruh data siswa di dalamnya akan dihapus permanen.
      </div>
      <form method="POST" id="form-hapus">
        @csrf
        @method('DELETE')
        <div style="display:flex; gap:8px; justify-content:center;">
          <button type="button" class="btn btn-ghost" onclick="tutupModal('modal-hapus')">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
function bukaModal(id)  { document.getElementById(id).classList.add('show'); }
function tutupModal(id) { document.getElementById(id).classList.remove('show'); }

function bukaModalTambah() { bukaModal('modal-tambah'); }

function bukaModalEdit(id, nama, mulai, selesai) {
  document.getElementById('form-edit').action = `/tahun-ajaran/${id}`;
  document.getElementById('edit-nama').value   = nama;
  document.getElementById('edit-mulai').value  = mulai;
  document.getElementById('edit-selesai').value = selesai;
  bukaModal('modal-edit');
}

function bukaModalHapus(id, nama) {
  document.getElementById('form-hapus').action = `/tahun-ajaran/${id}`;
  document.getElementById('hapus-nama').textContent = nama;
  bukaModal('modal-hapus');
}

// Buka modal tambah otomatis jika ada error validasi
@if ($errors->any())
  bukaModalTambah();
@endif

// Tutup modal klik di luar
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('show');
  });
});
</script>
@endsection
