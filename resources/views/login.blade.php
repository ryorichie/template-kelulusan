<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login – Nama Sekolah Anda</title>
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
  position: relative;
  overflow: hidden;
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

/* Strip emas animasi */
.header-strip {
  position: fixed; top: 0; left: 0; right: 0; height: 5px;
  background: linear-gradient(90deg, var(--emas), var(--emas-light), var(--hijau-muda), var(--emas-light), var(--emas));
  background-size: 300%;
  animation: geser 4s linear infinite;
  z-index: 50;
}

@keyframes geser {
  0%   { background-position: 0% 50%; }
  100% { background-position: 200% 50%; }
}

/* Card */
.card {
  background: var(--hijau-mid);
  border: 1px solid rgba(212,160,23,0.35);
  border-radius: 20px;
  padding: 2.75rem 2.5rem;
  width: 420px;
  max-width: 93vw;
  position: relative;
  z-index: 1;
  box-shadow: 0 8px 60px rgba(0,0,0,0.45), 0 0 0 1px rgba(212,160,23,0.1) inset;
  animation: masuk 0.5s cubic-bezier(.34,1.4,.64,1) both;
}

@keyframes masuk {
  from { opacity: 0; transform: translateY(24px) scale(0.97); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

.card::before, .card::after {
  content: '✦';
  position: absolute;
  color: rgba(212,160,23,0.25);
  font-size: 18px; top: 14px;
}
.card::before { left: 16px; }
.card::after  { right: 16px; }

/* Logo area */
.logo-area {
  display: flex; align-items: center; justify-content: center;
  gap: 14px; margin-bottom: 1.5rem; text-align: left;
}

.logo-circle {
  width: 60px; height: 60px; border-radius: 50%;
  background: #f3f3f3;
  border: 1.5px solid rgba(212,160,23,0.45);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.logo-circle img { width: 36px; height: 36px; }

.kemenag-label {
  font-size: 9px; font-weight: 700; letter-spacing: 2.5px;
  text-transform: uppercase; color: var(--emas); margin-bottom: 2px;
}
.school-name {
  font-family: 'Amiri', serif; font-size: 16px; font-weight: 700;
  color: var(--putih); line-height: 1.2;
}
.school-sub { font-size: 10.5px; color: rgba(255,255,255,0.45); margin-top: 1px; }

/* Garis */
.garis {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(212,160,23,0.45), transparent);
  margin: 0 0 1.5rem;
}

/* Judul */
.judul-area { text-align: center; margin-bottom: 1.75rem; }

.arab {
  font-family: 'Amiri', serif; font-size: 15px;
  color: var(--emas); direction: rtl; margin-bottom: 4px;
}

h1 {
  font-family: 'Amiri', serif; font-size: 22px; font-weight: 700;
  color: var(--putih); margin-bottom: 4px;
}

.sub-judul { font-size: 12px; color: rgba(255,255,255,0.38); line-height: 1.5; }

/* Form */
.form-group { margin-bottom: 1.1rem; }

label {
  display: block; font-size: 10.5px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: rgba(255,255,255,0.38); margin-bottom: 7px;
}

.input-wrap { position: relative; }

.input-wrap input {
  width: 100%; padding: 12px 42px 12px 14px;
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 10px; color: var(--putih);
  font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
  outline: none; transition: border-color 0.2s, background 0.2s;
  caret-color: var(--emas);
}

.input-wrap input:focus {
  border-color: rgba(212,160,23,0.55);
  background: rgba(212,160,23,0.06);
  box-shadow: 0 0 0 3px rgba(212,160,23,0.1);
}

.input-wrap input::placeholder { color: rgba(255,255,255,0.2); font-size: 13px; }

/* Icon dalam input */
.input-icon {
  position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
  color: rgba(255,255,255,0.25); pointer-events: none;
  display: flex; align-items: center;
}

/* Toggle password */
.toggle-pass {
  position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
  background: none; border: none; cursor: pointer; padding: 0;
  color: rgba(255,255,255,0.25); display: flex; align-items: center;
  transition: color 0.2s;
}
.toggle-pass:hover { color: rgba(255,255,255,0.6); }

/* Error */
.alert-err {
  background: rgba(220,38,38,0.15);
  border: 1px solid rgba(220,38,38,0.35);
  border-radius: 8px; padding: 10px 14px;
  font-size: 12.5px; color: #fca5a5;
  margin-bottom: 1.1rem; display: flex; align-items: center; gap: 8px;
}

/* Remember & forgot */
.row-opt {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 1.5rem;
}

.remember {
  display: flex; align-items: center; gap: 8px;
  font-size: 12px; color: rgba(255,255,255,0.45); cursor: pointer;
}

.remember input[type="checkbox"] {
  width: 15px; height: 15px; accent-color: var(--emas);
  cursor: pointer;
}

.lupa {
  font-size: 12px; color: var(--emas-light);
  text-decoration: none; opacity: 0.8; transition: opacity 0.2s;
}
.lupa:hover { opacity: 1; }

/* Tombol login */
.btn-login {
  width: 100%; padding: 13px;
  background: linear-gradient(135deg, #b8861a, var(--emas), var(--emas-light), var(--emas), #b8861a);
  background-size: 300% 300%;
  border: none; border-radius: 10px;
  color: #2a1800; font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14px; font-weight: 700; letter-spacing: 0.5px;
  text-transform: uppercase; cursor: pointer;
  transition: transform 0.15s, box-shadow 0.15s;
  animation: shimmer 3s ease infinite;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}

.btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(212,160,23,0.4); }
.btn-login:active { transform: scale(0.98); }
.btn-login:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

@keyframes shimmer {
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Footer */
.footer {
  position: fixed; bottom: 14px; left: 0; right: 0;
  text-align: center; font-size: 10px; color: rgba(255,255,255,0.18);
  letter-spacing: 1px; text-transform: uppercase; z-index: 2;
}
</style>
</head>
<body>

<div class="header-strip"></div>

<div class="card">

  <!-- Logo -->
  <div class="logo-area">
    <div class="logo-circle">
      <img src="{{asset('img/logo_sekolah.png')}}" alt="" srcset="">
    </div>
    <div>
      <div class="kemenag-label">Kementerian Agama RI</div>
      <div class="school-name">Nama Sekolah Anda</div>
      <div class="school-sub">Madrasah Tsanawiyah Negeri</div>
    </div>
  </div>

  <div class="garis"></div>

  <!-- Judul -->
  <div class="judul-area">
    <div class="arab">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</div>
    <h1>Portal Admin</h1>
    <p class="sub-judul">Silakan masuk untuk mengelola data kelulusan</p>
  </div>

  <!-- Alert error (tampil jika ada) -->
  @if (session('error') || $errors->any())
  <div class="alert-err">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    @if (session('error'))
      {{ session('error') }}
    @else
      {{ $errors->first() }}
    @endif
  </div>
  @endif

  <!-- Form -->
  <form method="POST" action="{{ route('login') }}" id="form-login">
    @csrf

    <!-- Email -->
    <div class="form-group">
      <label for="email">Alamat Email</label>
      <div class="input-wrap">
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="admin@namasekolah.sch.id"
          required
          autocomplete="email"
          autofocus
        />
        <span class="input-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </span>
      </div>
    </div>

    <!-- Password -->
    <div class="form-group">
      <label for="password">Kata Sandi</label>
      <div class="input-wrap">
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Masukkan kata sandi..."
          required
          autocomplete="current-password"
        />
        <button type="button" class="toggle-pass" onclick="togglePassword()" id="toggle-btn" aria-label="Tampilkan kata sandi">
          <!-- Ikon mata tertutup (default) -->
          <svg id="icon-hide" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
          <!-- Ikon mata terbuka -->
          <svg id="icon-show" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </button>
      </div>
    </div>

    <!-- Remember & lupa password -->
    <div class="row-opt">
      <label class="remember">
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
        Ingat saya
      </label>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="lupa">Lupa kata sandi?</a>
      @endif
    </div>

    <!-- Tombol -->
    <button type="submit" class="btn-login" id="btn-submit">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
      Masuk
    </button>

  </form>

</div>

<div class="footer">Nama Sekolah Anda · Kementerian Agama RI · Kabupaten Jember</div>

<script>
function togglePassword() {
  const input    = document.getElementById('password');
  const iconHide = document.getElementById('icon-hide');
  const iconShow = document.getElementById('icon-show');
  const isHidden = input.type === 'password';

  input.type        = isHidden ? 'text' : 'password';
  iconHide.style.display = isHidden ? 'none'  : '';
  iconShow.style.display = isHidden ? ''      : 'none';
}

// Disable tombol saat submit agar tidak double-submit
document.getElementById('form-login').addEventListener('submit', function () {
  const btn = document.getElementById('btn-submit');
  btn.disabled = true;
  btn.innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
    Memproses...
  `;
});
</script>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
</body>
</html>
