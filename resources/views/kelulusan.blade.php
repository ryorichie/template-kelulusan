<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Pengumuman Kelulusan – Nama Sekolah Anda</title>
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
}

body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--hijau-tua);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  position: relative;
}

body::before {
  content: '';
  position: fixed; inset: 0;
  background-image: radial-gradient(circle, rgba(212,160,23,0.06) 1px, transparent 1px);
  background-size: 28px 28px;
  pointer-events: none;
}

body::after {
  content: '';
  position: fixed; inset: 0;
  background:
    linear-gradient(135deg, rgba(45,122,85,0.18) 0%, transparent 60%),
    linear-gradient(315deg, rgba(212,160,23,0.08) 0%, transparent 60%);
  pointer-events: none;
}

.header-strip {
  position: fixed; top: 0; left: 0; right: 0;
  height: 5px;
  background: linear-gradient(90deg, var(--emas), var(--emas-light), var(--hijau-muda), var(--emas-light), var(--emas));
  background-size: 300%;
  animation: geser 4s linear infinite;
  z-index: 50;
}

@keyframes geser {
  0%   { background-position: 0% 50%; }
  100% { background-position: 200% 50%; }
}

.main-card {
  background: var(--hijau-mid);
  border: 1px solid rgba(212,160,23,0.35);
  border-radius: 20px;
  padding: 2.75rem 2.5rem;
  width: 430px;
  max-width: 93vw;
  text-align: center;
  position: relative;
  z-index: 1;
  box-shadow: 0 8px 60px rgba(0,0,0,0.45), 0 0 0 1px rgba(212,160,23,0.1) inset;
}

.main-card::before, .main-card::after {
  content: '✦';
  position: absolute;
  color: rgba(212,160,23,0.25);
  font-size: 18px;
  top: 14px;
}
.main-card::before { left: 16px; }
.main-card::after  { right: 16px; }

.logo-area {
  display: flex; align-items: center; justify-content: center;
  gap: 14px; margin-bottom: 1.25rem;
}

.logo-circle {
  width: 64px; height: 64px; border-radius: 50%;
  background: #f3f3f3;
  border: 1.5px solid rgba(212,160,23,0.45);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.logo-circle img { width: 38px; height: 38px; }
.logo-text { text-align: left; }

.kemenag-label {
  font-size: 9.5px; font-weight: 700;
  letter-spacing: 2.5px; text-transform: uppercase;
  color: var(--emas); margin-bottom: 2px;
}

.school-name {
  font-family: 'Amiri', serif;
  font-size: 17px; font-weight: 700;
  color: var(--putih); line-height: 1.2;
}

.school-sub { font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 1px; }

.garis {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(212,160,23,0.5), transparent);
  margin: 1.25rem 0;
}

h1 {
  font-family: 'Amiri', serif;
  font-size: 24px; font-weight: 700;
  color: var(--putih); line-height: 1.35; margin-bottom: 6px;
}

.arab {
  font-family: 'Amiri', serif;
  font-size: 16px; color: var(--emas);
  direction: rtl; margin-bottom: 4px; letter-spacing: 1px;
}

.subtitle {
  font-size: 12.5px; color: rgba(255,255,255,0.42);
  line-height: 1.65; margin-bottom: 1.75rem;
}

.divider { display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; }
.divider::before, .divider::after {
  content: ''; flex: 1; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(212,160,23,0.3), transparent);
}
.divider span { font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase; color: rgba(255,255,255,0.28); }

label {
  display: block; font-size: 10.5px; letter-spacing: 1.5px;
  text-transform: uppercase; color: rgba(255,255,255,0.38);
  text-align: left; margin-bottom: 8px;
}

input[type="text"] {
  width: 100%; padding: 13px 16px;
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 10px; color: var(--putih);
  font-size: 19px; font-family: 'Plus Jakarta Sans', sans-serif;
  font-weight: 600; letter-spacing: 4px; text-align: center;
  outline: none; transition: border-color 0.2s, background 0.2s;
  margin-bottom: 6px; caret-color: var(--emas);
}

input[type="text"]:focus {
  border-color: rgba(212,160,23,0.55);
  background: rgba(212,160,23,0.06);
  box-shadow: 0 0 0 3px rgba(212,160,23,0.1);
}

input[type="text"]::placeholder { color: rgba(255,255,255,0.18); letter-spacing: 1px; font-size: 13px; font-weight: 400; }

.err { font-size: 11.5px; color: #f87171; min-height: 18px; margin-bottom: 14px; text-align: left; }

.btn {
  width: 100%; padding: 14px;
  background: linear-gradient(135deg, #b8861a, var(--emas), var(--emas-light), var(--emas), #b8861a);
  background-size: 300% 300%;
  border: none; border-radius: 10px; color: #2a1800;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14px; font-weight: 700; letter-spacing: 0.5px;
  cursor: pointer; transition: transform 0.15s, box-shadow 0.15s;
  animation: shimmer 3s ease infinite; text-transform: uppercase;
}

.btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(212,160,23,0.4); }
.btn:active { transform: scale(0.98); }

@keyframes shimmer {
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* ---- OVERLAY ---- */
.overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.78);
  backdrop-filter: blur(5px);
  display: flex; align-items: center; justify-content: center;
  z-index: 100; opacity: 0; pointer-events: none; transition: opacity 0.3s;
}
.overlay.show { opacity: 1; pointer-events: all; }

/* ---- POPUP ---- */
.popup {
  border-radius: 20px; padding: 0;
  width: 400px; max-width: 92vw; text-align: center;
  position: relative;
  transform: scale(0.75) translateY(40px); opacity: 0;
  transition: transform 0.45s cubic-bezier(.34,1.56,.64,1), opacity 0.3s;
  overflow: hidden;
}
.overlay.show .popup { transform: scale(1) translateY(0); opacity: 1; }

.popup.lulus { background: #f0faf5; }
.popup.lulus .popup-header { background: linear-gradient(135deg, #1a4731, #2d7a55); padding: 1.75rem 1.5rem 1.25rem; }
.popup.lulus .popup-header-stripe {
  height: 4px;
  background: linear-gradient(90deg, var(--emas), var(--emas-light), var(--emas));
  background-size: 200%; animation: shimmer 2s infinite;
}

.popup.tidak { background: #fff8f8; }
.popup.tidak .popup-header { background: linear-gradient(135deg, #3d1010, #7f1d1d); padding: 1.75rem 1.5rem 1.25rem; }
.popup.tidak .popup-header-stripe { height: 4px; background: #c0392b; }

.popup-header-stripe { position: absolute; top: 0; left: 0; right: 0; }

.popup-icon {
  width: 70px; height: 70px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 0.9rem; font-size: 30px;
  animation: popIn 0.5s 0.25s both;
}
.popup.lulus .popup-icon { background: rgba(255,255,255,0.15); }
.popup.tidak .popup-icon { background: rgba(255,255,255,0.12); }

@keyframes popIn {
  from { transform: scale(0) rotate(-10deg); opacity: 0; }
  to   { transform: scale(1) rotate(0deg); opacity: 1; }
}

.popup-header-title {
  font-family: 'Amiri', serif; font-size: 21px; font-weight: 700;
  color: #fff; margin-bottom: 4px; animation: fadeUp 0.5s 0.3s both;
}

.popup-header-sub { font-size: 11px; color: rgba(255,255,255,0.55); letter-spacing: 1px; text-transform: uppercase; animation: fadeUp 0.5s 0.35s both; }

.popup-body { padding: 1.5rem 1.75rem; }

/* Info siswa */
.info-grid {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 8px; margin-bottom: 1rem;
  animation: fadeUp 0.5s 0.38s both;
}

.info-item {
  padding: 8px 10px; border-radius: 8px; text-align: left;
}
.popup.lulus  .info-item { background: #d1fae5; }
.popup.tidak  .info-item { background: #fee2e2; }

.info-label {
  font-size: 9px; font-weight: 700; letter-spacing: 1.5px;
  text-transform: uppercase; margin-bottom: 2px;
}
.popup.lulus  .info-label { color: #047857; }
.popup.tidak  .info-label { color: #b91c1c; }

.info-value { font-size: 13px; font-weight: 600; }
.popup.lulus  .info-value { color: #064e3b; }
.popup.tidak  .info-value { color: #7f1d1d; }

.info-item.full { grid-column: 1 / -1; }

.badge-status {
  display: inline-block; padding: 4px 16px; border-radius: 999px;
  font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
}
.popup.lulus  .badge-status { background: #059669; color: #fff; }
.popup.tidak  .badge-status { background: #dc2626; color: #fff; }

.popup-msg {
  font-size: 12.5px; line-height: 1.75; margin-bottom: 1rem;
  animation: fadeUp 0.5s 0.45s both;
}
.popup.lulus .popup-msg { color: #064e3b; }
.popup.tidak .popup-msg { color: #7f1d1d; }

.popup-ayat {
  font-family: 'Amiri', serif; font-size: 14px; direction: rtl;
  padding: 10px 14px; border-radius: 8px; margin-bottom: 1.25rem;
  animation: fadeUp 0.5s 0.5s both; line-height: 1.8;
}
.popup.lulus .popup-ayat { background: #d1fae5; color: #047857; }
.popup.tidak .popup-ayat { background: #fee2e2; color: #b91c1c; }

.popup-ayat-latin {
  font-size: 11px; direction: ltr; display: block;
  margin-top: 4px; font-style: italic; opacity: 0.75;
  font-family: 'Plus Jakarta Sans', sans-serif;
}

.btn-close {
  width: 100%; padding: 12px 28px; border-radius: 10px; border: none;
  font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 0.5px;
  cursor: pointer; transition: transform 0.15s, opacity 0.15s;
  animation: fadeUp 0.5s 0.55s both;
}
.btn-close:hover { transform: translateY(-1px); opacity: 0.88; }
.popup.lulus .btn-close { background: #1a4731; color: #fff; }
.popup.tidak .btn-close { background: #7f1d1d; color: #fff; }

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

#fx-canvas { position: fixed; inset: 0; pointer-events: none; z-index: 200; }

.footer {
  position: fixed; bottom: 14px; left: 0; right: 0;
  text-align: center; font-size: 10px; color: rgba(255,255,255,0.18);
  letter-spacing: 1px; text-transform: uppercase; z-index: 2;
}
</style>
</head>
<body>

<div class="header-strip"></div>
<canvas id="fx-canvas"></canvas>

{{-- ===================== CARD UTAMA ===================== --}}
<div class="main-card">

  <div class="logo-area">
    <div class="logo-circle">
      <img src="{{asset('img/logo_sekolah.png')}}" alt="" srcset="">
    </div>
    <div class="logo-text">
      <div class="kemenag-label">Kementerian Agama RI</div>
      <div class="school-name">Nama Sekolah Anda</div>
      <div class="school-sub">Madrasah Tsanawiyah Negeri</div>
    </div>
  </div>

  <div class="garis"></div>

  <div class="arab">إعلان نتائج الامتحان</div>
  <h1>Pengumuman Kelulusan</h1>
  <p class="subtitle">
    Masukkan Nomor Induk Siswa (NIS) untuk mengetahui<br>
    status kelulusan tahun ajaran ini.
  </p>

  <div class="divider"><span>Cek Status</span></div>

  <label for="nis">Nomor Induk Siswa (NIS)</label>
  <input type="text" id="nis" placeholder="Masukkan NIS kamu..."
    maxlength="20" autocomplete="off"
    onkeydown="if(event.key==='Enter') cek()" />
  <p class="err" id="err"></p>
  <button class="btn" onclick="cek()">★ Cek Kelulusan ★</button>

</div>

<div class="footer">Nama Sekolah Anda · Kementerian Agama RI · Kabupaten Jember</div>

{{-- ===================== OVERLAY + POPUP ===================== --}}
<div class="overlay" id="overlay">
  <div class="popup" id="popup">

    {{-- Header popup --}}
    <div class="popup-header">
      <div class="popup-header-stripe"></div>
      <div class="popup-icon" id="p-icon"></div>
      <div class="popup-header-title" id="p-title"></div>
      <div class="popup-header-sub">Nama Sekolah Anda</div>
    </div>

    {{-- Body popup --}}
    <div class="popup-body">
      <div class="info-grid" id="p-grid"></div>
      <div class="popup-msg" id="p-msg"></div>
      <div class="popup-ayat" id="p-ayat"></div>
      <button class="btn-close" onclick="tutup()">Tutup</button>
    </div>

  </div>
</div>

{{-- ===================== POPUP BELUM DIBUKA ===================== --}}
@if(!$periode)
<div id="overlay-belum-dibuka" style="
  position:fixed; inset:0; z-index:9999;
  background:rgba(15,23,42,0.7);
  display:flex; align-items:center; justify-content:center;
  backdrop-filter:blur(4px);
">
  <div style="
    background:#fff; border-radius:16px; max-width:420px; width:90%;
    box-shadow:0 20px 60px rgba(0,0,0,0.25); overflow:hidden;
    animation: popIn .3s ease;
  ">

    {{-- Header --}}
    <div style="background:linear-gradient(135deg,#1e40af,#3b82f6); padding:28px 24px 20px; text-align:center;">
      <div style="font-size:48px; margin-bottom:8px;">🔒</div>
      <div style="color:#fff; font-size:18px; font-weight:700; margin-bottom:4px;">Pengumuman Belum Dibuka</div>
      <div style="color:#bfdbfe; font-size:13px;">Nama Sekolah Anda</div>
    </div>

    {{-- Body --}}
    <div style="padding:24px;">

      <p style="text-align:center; color:#374151; font-size:14px; line-height:1.7; margin:0 0 20px;">
        Pengumuman kelulusan untuk tahun pelajaran ini belum dapat diakses saat ini.
        Silakan kembali pada tanggal yang telah ditentukan.
      </p>

      {{-- Cari tahun ajaran terdekat yang belum dibuka --}}
      @php
        $terdekat = \App\Models\TahunAjaran::whereDate('tanggal_mulai_pengumuman', '>', now())
          ->orderBy('tanggal_mulai_pengumuman')
          ->first();
      @endphp

      @if($terdekat)
      <div style="
        background:#eff6ff; border:1px solid #bfdbfe; border-radius:10px;
        padding:14px 16px; margin-bottom:20px; text-align:center;
      ">
        <div style="font-size:12px; color:#1d4ed8; font-weight:600; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">
          📅 Jadwal Pengumuman
        </div>
        <div style="font-size:15px; font-weight:700; color:#1e3a8a;">
          {{ \Carbon\Carbon::parse($terdekat->tanggal_mulai_pengumuman)->translatedFormat('d F Y') }}
        </div>
        <div style="font-size:12px; color:#6b7280; margin-top:2px;">
          s/d {{ \Carbon\Carbon::parse($terdekat->tanggal_selesai_pengumuman)->translatedFormat('d F Y') }}
        </div>
        @if($terdekat->nama)
        <div style="font-size:12px; color:#3b82f6; margin-top:6px; font-weight:500;">
          Tahun Pelajaran {{ $terdekat->nama }}
        </div>
        @endif
      </div>
      @else
      <div style="
        background:#fefce8; border:1px solid #fde68a; border-radius:10px;
        padding:14px 16px; margin-bottom:20px; text-align:center;
        font-size:13px; color:#92400e;
      ">
        ⏳ Jadwal pengumuman belum ditetapkan. Pantau terus informasi dari sekolah.
      </div>
      @endif

      <div style="text-align:center; font-size:12px; color:#9ca3af; margin-bottom:16px;">
        Untuk informasi lebih lanjut, hubungi pihak sekolah.
      </div>

      <button
        onclick="document.getElementById('overlay-belum-dibuka').style.display='none'"
        style="
          width:100%; padding:11px; background:linear-gradient(135deg,#1e40af,#3b82f6);
          color:#fff; font-size:14px; font-weight:600; border:none;
          border-radius:8px; cursor:pointer; transition:opacity .2s;
        "
        onmouseover="this.style.opacity='.85'"
        onmouseout="this.style.opacity='1'"
      >
        Mengerti
      </button>

    </div>
  </div>
</div>

<style>
  @keyframes popIn {
    from { transform: scale(.9); opacity: 0; }
    to   { transform: scale(1);  opacity: 1; }
  }
</style>
@endif

{{-- ===================== DATA DARI CONTROLLER ===================== --}}
<script>
  const DATA_SISWA = @json($data->keyBy('nis'));
  const PERIODE    = @json($periode);
  console.log(DATA_SISWA);
</script>

<script>
function cek() {
  const nis = document.getElementById('nis').value.trim();
  const err = document.getElementById('err');

  if (!PERIODE) {
    err.textContent = '⚠ Pengumuman belum dibuka.';
    return;
  }

  // === VALIDASI PERIODE ===
  const today   = new Date();
  const mulai   = new Date(PERIODE.mulai);
  const selesai = new Date(PERIODE.selesai);

  today.setHours(0,0,0,0);
  mulai.setHours(0,0,0,0);
  selesai.setHours(0,0,0,0);

  if (today < mulai || today > selesai) {
    err.textContent = `⚠ Pengumuman hanya dapat diakses pada ${formatTanggal(mulai)} - ${formatTanggal(selesai)}.`;
    return;
  }
  if (!nis) {
    err.textContent = '⚠ NIS tidak boleh kosong.';
    return;
  }

  if (!DATA_SISWA[nis]) {
    err.textContent = '⚠ NIS tidak ditemukan. Periksa kembali nomor kamu.';
    return;
  }

  err.textContent = '';
  tampilPopup(DATA_SISWA[nis]);
}

function tampilPopup(siswa) {
  const lulus  = siswa.status === 'Lulus';
  const popup  = document.getElementById('popup');
  popup.className = 'popup ' + (lulus ? 'lulus' : 'tidak');

  // Icon & judul
  document.getElementById('p-icon').textContent  = lulus ? '🎓' : '😢';
  document.getElementById('p-title').textContent = lulus ? 'Selamat, Anda Lulus!' : 'Mohon Maaf, Belum Lulus';

  // Info grid siswa
  document.getElementById('p-grid').innerHTML = `
    <div class="info-item full">
      <div class="info-label">Nama Lengkap</div>
      <div class="info-value">${siswa.nama}</div>
    </div>
    <div class="info-item">
      <div class="info-label">NIS</div>
      <div class="info-value">${siswa.nis}</div>
    </div>
    <div class="info-item">
      <div class="info-label">Jenis Kelamin</div>
      <div class="info-value">
  ${siswa.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
</div>
    </div>
    <div class="info-item">
      <div class="info-label">Kelas</div>
      <div class="info-value">${siswa.kelas}</div>
    </div>
    <div class="info-item">
      <div class="info-label">Tahun Pelajaran</div>
      <div class="info-value">${siswa.tahun_ajaran.nama}</div>
    </div>
    <div class="info-item full" style="text-align:center;">
      <div class="info-label" style="text-align:center; margin-bottom:6px;">Status Kelulusan</div>
      <span class="badge-status">${siswa.status}</span>
    </div>
  `;

  // Pesan & ayat
  document.getElementById('p-msg').textContent = lulus
    ? 'Alhamdulillah, kamu dinyatakan LULUS. Selamat atas pencapaian luar biasa ini! Semoga ilmu yang diperoleh menjadi bekal kehidupan dunia dan akhirat.'
    : 'Innalillahi, kamu dinyatakan BELUM LULUS. Jangan berkecil hati. Allah SWT memiliki rencana terbaik. Tetap semangat dan terus berjuang!';

  document.getElementById('p-ayat').innerHTML = lulus
    ? 'فَإِنَّ مَعَ الْعُسْرِ يُسْرًا<span class="popup-ayat-latin">"Sesungguhnya bersama kesulitan ada kemudahan." (QS. Al-Insyirah: 5)</span>'
    : 'إِنَّ اللَّهَ مَعَ الصَّابِرِينَ<span class="popup-ayat-latin">"Sesungguhnya Allah bersama orang-orang yang sabar." (QS. Al-Baqarah: 153)</span>';

  document.getElementById('overlay').classList.add('show');

  if (lulus) startConfetti(); else startRain();
}

function tutup() {
  document.getElementById('overlay').classList.remove('show');
  stopFx();
}

/* ---- FX ENGINE ---- */
const canvas = document.getElementById('fx-canvas');
const ctx    = canvas.getContext('2d');
let particles = [], fxActive = false, rafId;

function resize() { canvas.width = innerWidth; canvas.height = innerHeight; }
resize(); window.addEventListener('resize', resize);

function startConfetti() {
  stopFx(); fxActive = true;
  const colors = ['#d4a017','#f0c84a','#2d7a55','#4caf78','#a3e4bc','#fff','#86efac','#fde68a'];
  for (let i = 0; i < 180; i++) {
    const shape = Math.random() < 0.4 ? 'circle' : 'rect';
    particles.push({
      x: Math.random() * canvas.width,
      y: -20 - Math.random() * 300,
      w: 7 + Math.random() * 9, h: 5 + Math.random() * 6, r: 3 + Math.random() * 5,
      color: colors[Math.floor(Math.random() * colors.length)],
      speed: 1.8 + Math.random() * 4.5,
      vx: (Math.random() - 0.5) * 2.5,
      rot: Math.random() * Math.PI * 2,
      rotSpeed: (Math.random() - 0.5) * 0.14,
      shape, type: 'confetti'
    });
  }
  loop();
}

function startRain() {
  stopFx(); fxActive = true;
  for (let i = 0; i < 90; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: -Math.random() * canvas.height,
      len: 14 + Math.random() * 22,
      speed: 5 + Math.random() * 7,
      alpha: 0.15 + Math.random() * 0.45,
      type: 'rain'
    });
  }
  loop();
}

function loop() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  let alive = false;
  for (const p of particles) {
    if (p.type === 'confetti') {
      p.y += p.speed; p.x += p.vx; p.rot += p.rotSpeed;
      if (p.y < canvas.height + 30) alive = true;
      ctx.save();
      ctx.translate(p.x, p.y); ctx.rotate(p.rot);
      ctx.fillStyle = p.color; ctx.globalAlpha = 0.88;
      if (p.shape === 'circle') { ctx.beginPath(); ctx.arc(0,0,p.r,0,Math.PI*2); ctx.fill(); }
      else { ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h); }
      ctx.restore();
    } else {
      p.y += p.speed;
      if (p.y > canvas.height + p.len) { p.y = -p.len; p.x = Math.random() * canvas.width; }
      alive = true;
      ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(p.x - 1.5, p.y + p.len);
      ctx.strokeStyle = `rgba(150,200,255,${p.alpha})`; ctx.lineWidth = 1.2; ctx.stroke();
    }
  }
  if (fxActive && alive) rafId = requestAnimationFrame(loop);
  else ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function stopFx() {
  fxActive = false; cancelAnimationFrame(rafId);
  ctx.clearRect(0, 0, canvas.width, canvas.height); particles = [];
}

document.getElementById('overlay').addEventListener('click', function(e) {
  if (e.target === this) tutup();
});
</script>
</body>
</html>
