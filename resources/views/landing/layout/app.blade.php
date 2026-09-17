<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Desa Cimeong - Sistem Informasi Desa')</title>
<meta name="description" content="@yield('description', 'Sistem Informasi dan Pelayanan Publik Desa Cimeong')">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="{{ asset('landing/assets/bootstrap.min.css') }}" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="{{ asset('landing/assets/style.css') }}" rel="stylesheet" />
<link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/hand-heart.png') }}">

@stack('styles')

<style>
/* Custom Override untuk Desa */
:root {
  --clr-primary: #0d6efd;
  --clr-primary-dark: #0a58ca;
  --clr-primary-light: #cfe2ff;
}

/* Center subtitle/description text */
.section-sub {
  text-align: center;
  margin-left: auto;
  margin-right: auto;
  max-width: 800px;
}

/* Fix galeri card image to be full cover */
.galeri-img img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center !important;
}

/* Hero lead text center on mobile */
@media (max-width: 991px) {
  .hero-lead {
    text-align: center;
  }
}
</style>
</head>
<body>

@php $kontakData = \App\Models\Kontak::first(); @endphp

<!-- PRELOADER -->
<div id="preloader" aria-hidden="true">
  <div class="preload-ring">
    @if($kontakData && $kontakData->logo)
      <img src="{{ asset('storage/' . $kontakData->logo) }}" alt="Logo Desa" style="width:60px;height:60px;object-fit:contain;border-radius:50%;background:rgba(255,255,255,0.15);">
    @else
      <i class="bi bi-building-fill-gear preload-heart" style="color:#fff;font-size:2.1rem;"></i>
    @endif
  </div>
  <div class="preload-text">{{ strtoupper($kontakData->nama_desa ?? 'DESA CIMEONG') }}&hellip;</div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-hw" id="mainNav">
  <div class="container">
    <a class="hw-logo" href="{{ route('home') }}">
      @if($kontakData && $kontakData->logo)
        <img src="{{ asset('storage/' . $kontakData->logo) }}" alt="Logo" class="hw-logo-img" style="width:38px;height:38px;object-fit:contain;border-radius:8px;">
      @else
        <span class="hw-logo-mark"><i class="bi bi-building-fill-gear"></i></span>
      @endif
      @php
        $namaDesaFull = $kontakData->nama_desa ?? 'Desa Cimeong';
        $parts = explode(' ', $namaDesaFull, 2);
        $namaPrefix = $parts[0] ?? 'Desa';
        $namaSuffix = $parts[1] ?? 'Cimeong';
      @endphp
      {{ $namaPrefix }}<span class="dot">{{ $namaSuffix }}</span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2"></i>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav nav-hw mx-auto mt-3 mt-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('agenda') }}">Agenda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('layanan') }}">Layanan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
      </ul>
      @auth
        <a href="{{ route('admin.dashboard') }}" class="btn-hw-primary d-none d-lg-inline-flex">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      @else
        <a href="{{ route('login') }}" class="btn-hw-primary d-none d-lg-inline-flex">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
      @endauth
    </div>
  </div>
</nav>

<!-- CONTENT -->
@yield('content')

<!-- FOOTER -->
<footer class="footer-hw">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="hw-logo mb-3">
          @if($kontakData && $kontakData->logo)
            <img src="{{ asset('storage/' . $kontakData->logo) }}" alt="Logo" style="width:38px;height:38px;object-fit:contain;border-radius:8px;">
          @else
            <span class="hw-logo-mark"><i class="bi bi-building-fill-gear"></i></span>
          @endif
          @php
            $namaDesaFull2 = $kontakData->nama_desa ?? 'Desa Cimeong';
            $parts2 = explode(' ', $namaDesaFull2, 2);
          @endphp
          {{ $parts2[0] ?? 'Desa' }}<span class="dot">{{ $parts2[1] ?? 'Cimeong' }}</span>
        </div>
        <p class="text-muted">Sistem Informasi dan Pelayanan Publik Digital untuk warga Desa Cimeong yang lebih cepat, transparan, dan modern.</p>
        <div class="d-flex gap-2 mt-3">
          @if(!empty($kontak->facebook ?? ''))
            <a href="{{ $kontak->facebook }}" class="footer-social" target="_blank"><i class="bi bi-facebook"></i></a>
          @endif
          @if(!empty($kontak->instagram ?? ''))
            <a href="{{ $kontak->instagram }}" class="footer-social" target="_blank"><i class="bi bi-instagram"></i></a>
          @endif
          @if(!empty($kontak->youtube ?? ''))
            <a href="{{ $kontak->youtube }}" class="footer-social" target="_blank"><i class="bi bi-youtube"></i></a>
          @endif
        </div>
      </div>
      <div class="col-lg-2 col-6">
        <h6>Navigasi</h6>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Beranda</a></li>
          <li><a href="{{ route('profil') }}">Profil Desa</a></li>
          <li><a href="{{ route('berita') }}">Berita</a></li>
          <li><a href="{{ route('agenda') }}">Agenda</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-6">
        <h6>Layanan</h6>
        <ul class="footer-links">
          <li><a href="{{ route('layanan') }}">Permohonan Surat</a></li>
          <li><a href="{{ route('pengumuman') }}">Pengumuman</a></li>
          <li><a href="{{ route('galeri') }}">Galeri</a></li>
          <li><a href="{{ route('kontak') }}">Kontak</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h6>Kontak Kami</h6>
        <ul class="footer-links">
          <li><i class="bi bi-geo-alt-fill me-2"></i> {{ $kontak->alamat ?? 'Desa Cimeong, Jawa Barat' }}</li>
          <li><i class="bi bi-telephone-fill me-2"></i> {{ $kontak->no_telepon ?? '-' }}</li>
          <li><i class="bi bi-envelope-fill me-2"></i> {{ $kontak->email ?? '-' }}</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 text-center text-md-start">
            © {{ date('Y') }} Desa Cimeong. All rights reserved.
          </div>
          <div class="col-md-6 text-center text-md-end">
            Made with <i class="bi bi-heart-fill text-danger"></i> for Desa Cimeong
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to Top -->
<a href="#" id="scrollTop"><i class="bi bi-arrow-up"></i></a>

<!-- Scripts -->
<script src="{{ asset('landing/assets/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('landing/assets/script.js') }}"></script>

@stack('scripts')

</body>
</html>
