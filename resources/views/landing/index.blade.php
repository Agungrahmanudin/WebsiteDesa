@extends('landing.layout.app')

@section('title', 'Beranda - ' . ($kontakDesa->nama_desa ?? 'Desa'))
@section('description', 'Sistem Informasi dan Pelayanan Publik ' . ($kontakDesa->nama_desa ?? 'Desa') . ' yang transparan dan modern')

@section('content')

<!-- HERO SECTION -->
<header class="hero" id="home">
  <div class="hero-glow"></div>
  <span class="blob blob-1"></span>
  <span class="blob blob-2"></span>
  <span class="blob blob-3"></span>
  <div class="container position-relative">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <span class="eyebrow"><i class="bi bi-stars"></i> {{ number_format($totalPenduduk) }} Warga Terdaftar</span>
        <h1 class="hero-title mt-4">Layanan Desa <span class="accent-underline">Digital<svg viewBox="0 0 200 14" preserveAspectRatio="none"><path d="M2 10 Q 50 2 100 8 T 198 6" stroke="#0d6efd" stroke-width="5" fill="none" stroke-linecap="round"/></svg></span> untuk Kemudahan Warga</h1>
        <p class="hero-lead mt-4">Sistem Informasi {{ $kontakDesa->nama_desa ?? 'Desa' }} hadir untuk memberikan layanan administrasi yang lebih cepat, transparan, dan mudah diakses oleh seluruh warga kapan saja, dimana saja.</p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="{{ route('layanan') }}" class="btn-hw-primary">Ajukan Surat Online <i class="bi bi-arrow-right"></i></a>
          <a href="{{ route('profil') }}" class="btn-hw-outline"><i class="bi bi-info-circle"></i> Tentang Desa</a>
        </div>
        <div class="d-flex align-items-center gap-3 mt-5">
          <div class="hero-avatars">
            @foreach($perangkat->take(3) as $p)
              @if($p->foto)
                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nama) }}&background=0d6efd&color=fff&size=120" alt="{{ $p->nama }}">
              @endif
            @endforeach
          </div>
          <div>
            <div class="fw-bold font-display" style="font-size:.9rem;">{{ $perangkat->count() }} Aparatur Desa</div>
            <div class="text-muted" style="font-size:.8rem;">melayani dengan dedikasi</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="120">
        <div class="hero-media">
          <div class="hero-media-frame">
            @php
              $heroImg = isset($kontak) && $kontak->hero_image
                ? asset('storage/' . $kontak->hero_image)
                : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=900&h=1000&fit=crop&auto=format';
            @endphp
            <img src="{{ $heroImg }}" alt="{{ $kontakDesa->nama_desa ?? 'Desa' }}" loading="lazy">
          </div>
          <div class="float-card float-card-1">
            <span class="fc-icon"><i class="bi bi-newspaper"></i></span>
            <div><div class="fc-val">{{ $totalBerita }}</div><div class="fc-label">Berita Terpublikasi</div></div>
          </div>
          <div class="float-card float-card-2">
            <span class="fc-icon"><i class="bi bi-shield-check"></i></span>
            <div><div class="fc-val">100%</div><div class="fc-label">Aman &amp; Terpercaya</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- IMPACT STATS -->
<section class="section-pad pt-0" id="impact">
  <div class="container">
    <div class="stats-band" data-aos="zoom-in">
      <div class="row g-0">
        <div class="col-6 col-md-3 stat-item">
          <div class="stat-num"><span class="counter">{{ $totalPenduduk }}</span></div>
          <div class="stat-label">Total Penduduk</div>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <div class="stat-num"><span class="counter">{{ $totalBerita }}</span></div>
          <div class="stat-label">Berita Desa</div>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <div class="stat-num"><span class="counter">{{ $totalAgenda }}</span></div>
          <div class="stat-label">Agenda Kegiatan</div>
        </div>
        <div class="col-6 col-md-3 stat-item">
          <div class="stat-num"><span class="counter">{{ $layanan->count() }}</span></div>
          <div class="stat-label">Layanan Surat</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LAYANAN SECTION -->
<section class="section-pad" id="layanan" style="background: var(--clr-surface);">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-7" data-aos="fade-up">
        <span class="eyebrow"><i class="bi bi-grid-3x3-gap"></i> Layanan Kami</span>
        <h2 class="section-title mt-3">Layanan Administrasi Desa</h2>
        <p class="section-sub mt-3">Akses mudah untuk berbagai jenis surat dan pelayanan administrasi kependudukan</p>
      </div>
    </div>

    <!-- Jam Pelayanan Card -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-12" data-aos="fade-up">
        <div class="p-4" style="background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 16px; box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);">
          <div class="d-flex align-items-center gap-3 mb-3 text-white">
            <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-clock" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <h5 class="mb-0 fw-bold">Jam Pelayanan</h5>
              <p class="mb-0 small opacity-90">Pelayanan administrasi warga dibuka pada:</p>
            </div>
          </div>
          <div class="row g-3 text-white">
            <div class="col-md-4">
              <div class="p-3 bg-white bg-opacity-10 rounded" style="backdrop-filter: blur(10px);">
                <div class="small opacity-90 mb-1">Senin - Kamis</div>
                <div class="h5 mb-0 fw-bold">{{ $kontak->jadwal_senin_kamis ?? '08.00 - 15.00' }}</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 bg-white bg-opacity-10 rounded" style="backdrop-filter: blur(10px);">
                <div class="small opacity-90 mb-1">Jumat</div>
                <div class="h5 mb-0 fw-bold">{{ $kontak->jadwal_jumat ?? '08.00 - 11.30' }}</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 bg-white bg-opacity-10 rounded" style="backdrop-filter: blur(10px);">
                <div class="small opacity-90 mb-1">Sabtu & Minggu</div>
                <div class="h5 mb-0 fw-bold">{{ $kontak->jadwal_weekend ?? 'Libur' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4">
      @foreach($layanan->take(6) as $lay)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
          <div class="cause-card h-100">
            <div class="cause-body">
              <div class="d-flex align-items-start gap-3 mb-3">
                <div style="width: 50px; height: 50px; background: var(--clr-primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--clr-primary); font-size: 1.5rem;">
                  <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="flex-grow-1">
                  <h5 class="cause-title">{{ $lay->nama_layanan }}</h5>
                </div>
              </div>
              <p class="cause-text">{{ $lay->deskripsi }}</p>
              <div class="text-muted small mb-3">
                <i class="bi bi-check-circle text-success me-1"></i> {{ $lay->persyaratan ?? 'KTP & KK' }}
              </div>
              <a href="{{ route('layanan') }}" class="btn-hw-outline w-100">
                <i class="bi bi-send"></i> Ajukan Sekarang
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- BERITA TERBARU -->
<section class="section-pad" id="berita">
  <div class="container">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow"><i class="bi bi-newspaper"></i> Informasi Terkini</span>
        <h2 class="section-title mt-3">Berita & Artikel Desa</h2>
      </div>
    </div>
    <div class="row g-4">
      @foreach($beritaTerbaru->take(3) as $b)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
          <div class="blog-card h-100">
            <div class="bc-img">
              @if($b->gambar)
                <img src="{{ Str::startsWith($b->gambar, 'http') ? $b->gambar : asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}">
              @else
                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&fit=crop" alt="{{ $b->judul }}">
              @endif
              <span class="bc-tag">{{ $b->kategori->nama_kategori ?? 'Umum' }}</span>
            </div>
            <div class="bc-body">
              <div class="bc-meta">
                <span><i class="bi bi-calendar3"></i> {{ $b->created_at->format('d M Y') }}</span>
              </div>
              <h5><a href="{{ route('berita.detail', $b->slug) }}" style="color:inherit;text-decoration:none;">{{ $b->judul }}</a></h5>
              <p>{{ Str::limit(strip_tags($b->isi), 100) }}</p>
              <a href="{{ route('berita.detail', $b->slug) }}" class="bc-link">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="{{ route('berita') }}" class="btn-hw-outline">Lihat Semua Berita <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- PENGUMUMAN -->
@if($pengumuman->count() > 0)
<section class="section-pad" style="background: var(--clr-surface);">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-7" data-aos="fade-up">
        <span class="eyebrow"><i class="bi bi-megaphone"></i> Informasi Penting</span>
        <h2 class="section-title mt-3">Pengumuman Resmi</h2>
      </div>
    </div>
    <div class="row g-4">
      @foreach($pengumuman->take(3) as $p)
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 60 }}">
          <div class="cause-card h-100 pengumuman-item">
            <div class="cause-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <h5 class="cause-title mb-0" style="line-height: 1.4;">{{ $p->judul }}</h5>
                @if($p->status == 'aktif')
                  <span class="badge" style="background: linear-gradient(135deg, #10b981, #059669); font-size: 0.7rem; padding: 4px 10px;">Aktif</span>
                @endif
              </div>
              <p class="cause-text" style="margin-bottom: 1rem; line-height: 1.6;">{{ Str::limit($p->isi, 120) }}</p>
              <div class="text-muted small d-flex align-items-center gap-1">
                <i class="bi bi-calendar-range"></i> 
                <span>{{ $p->tanggal_mulai ? $p->tanggal_mulai->format('d M') : '' }} - 
                {{ $p->tanggal_selesai ? $p->tanggal_selesai->format('d M Y') : 'Seterusnya' }}</span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- GALERI -->
@if($galeri->count() > 0)
<section class="section-pad" id="galeri">
  <div class="container">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow"><i class="bi bi-images"></i> Dokumentasi</span>
        <h2 class="section-title mt-3">Galeri Foto & Video</h2>
        <p class="section-sub mt-2">Dokumentasi kegiatan dan momen penting di {{ ucwords($kontakDesa->nama_desa ?? 'Desa') }}</p>
      </div>
    </div>
    <div class="row g-4">
      @foreach($galeri->take(6) as $g)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 70 }}">
          <div class="galeri-card">
            <a href="{{ route('galeri.detail', $g->id) }}" class="text-decoration-none">
              <div class="galeri-img">
                @if($g->kategori == 'foto')
                  <img src="{{ Str::startsWith($g->file, 'http') ? $g->file : asset('storage/' . $g->file) }}" alt="{{ $g->judul }}" loading="lazy">
                  <div class="galeri-overlay">
                    <div class="galeri-zoom">
                      <i class="bi bi-zoom-in"></i>
                    </div>
                  </div>
                @else
                  <div class="galeri-video-thumb">
                    <i class="bi bi-play-circle-fill"></i>
                    <span class="video-badge">VIDEO</span>
                  </div>
                  <div class="galeri-overlay">
                    <div class="galeri-zoom">
                      <i class="bi bi-play-circle"></i>
                    </div>
                  </div>
                @endif
              </div>
            </a>
            <div class="galeri-body">
              <h6 class="galeri-title">
                <a href="{{ route('galeri.detail', $g->id) }}" class="text-decoration-none text-dark hover-primary">
                  {{ $g->judul }}
                </a>
              </h6>
              <p class="galeri-desc">{{ Str::limit($g->keterangan, 80) ?: 'Dokumentasi kegiatan desa' }}</p>
              <div class="galeri-meta">
                <span class="badge {{ $g->kategori == 'foto' ? 'bg-primary' : 'bg-danger' }}">
                  <i class="bi bi-{{ $g->kategori == 'foto' ? 'image' : 'camera-video' }}"></i> 
                  {{ ucfirst($g->kategori) }}
                </span>
                <span class="text-muted small">{{ $g->created_at->format('d M Y') }}</span>
              </div>
              <a href="{{ route('galeri.detail', $g->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="{{ route('galeri') }}" class="btn-hw-outline">Lihat Semua Galeri <i class="bi bi-arrow-right"></i></a>
    </div>
  </div>
</section>
@endif

<!-- CTA SECTION -->
<section class="section-pad" style="background: var(--clr-surface);">
  <div class="container">
    <div class="cta-banner" data-aos="zoom-in">
      <div class="cta-content">
        <h2 class="cta-title">Butuh Bantuan Layanan Desa?</h2>
        <p class="cta-text">Tim kami siap membantu Anda dengan sepenuh hati. Hubungi kami atau kunjungi kantor desa untuk konsultasi langsung.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
          <a href="{{ route('layanan') }}" class="btn-hw-primary">Ajukan Surat <i class="bi bi-arrow-right"></i></a>
          <a href="{{ route('kontak') }}" class="btn-hw-outline">Hubungi Kami <i class="bi bi-telephone"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@push('styles')
<style>
.pengumuman-item {
  transition: all 0.3s ease;
  border-radius: 16px;
  overflow: hidden;
  border: 2px solid transparent;
}
.pengumuman-odd {
  background: linear-gradient(135deg, #fff4ed 0%, #ffedd5 100%);
  border-left: 5px solid #ea580c;
  border-color: #fed7aa;
}
.pengumuman-even {
  background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
  border-left: 5px solid #2563eb;
  border-color: #bfdbfe;
}
.pengumuman-item:hover {
  transform: translateY(-8px);
  box-shadow: 0 16px 32px rgba(0,0,0,0.15);
}
.pengumuman-odd:hover {
  background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
  border-color: #ea580c;
  box-shadow: 0 16px 32px rgba(234, 88, 12, 0.25);
}
.pengumuman-even:hover {
  background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
  border-color: #2563eb;
  box-shadow: 0 16px 32px rgba(37, 99, 235, 0.25);
}
.pengumuman-odd .cause-title {
  color: #9a3412 !important;
  font-weight: 700 !important;
}
.pengumuman-even .cause-title {
  color: #1e40af !important;
  font-weight: 700 !important;
}
.pengumuman-odd .cause-text {
  color: #7c2d12 !important;
}
.pengumuman-even .cause-text {
  color: #1e3a8a !important;
}

/* Galeri Styles - Warna Netral */
.galeri-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  height: 100%;
  display: flex;
  flex-direction: column;
  border-top: 4px solid #64748b;
}
.galeri-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.15);
  border-top-color: #334155;
}
.galeri-img {
  position: relative;
  overflow: hidden;
  padding-top: 75%; /* 4:3 Aspect Ratio */
  background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
}
.galeri-img img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center !important;
  transition: transform 0.5s ease;
}
.galeri-card:hover .galeri-img img {
  transform: scale(1.1);
}
.galeri-video-thumb {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #1e293b, #334155);
  color: #fff;
  font-size: 4rem;
}
.video-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: rgba(220, 38, 38, 0.9);
  color: #fff;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.7rem;
  font-weight: 600;
  letter-spacing: 0.5px;
}
.galeri-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}
.galeri-card:hover .galeri-overlay {
  opacity: 1;
}
.galeri-zoom {
  width: 60px;
  height: 60px;
  background: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--clr-primary);
  font-size: 1.5rem;
  transition: all 0.3s ease;
  text-decoration: none;
}
.galeri-zoom:hover {
  transform: scale(1.1);
  background: var(--clr-primary);
  color: #fff;
}
.galeri-body {
  padding: 1.25rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
}
.galeri-title {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  color: var(--clr-heading);
  line-height: 1.4;
}
.galeri-title a.hover-primary:hover {
  color: var(--clr-primary) !important;
  transition: color 0.3s ease;
}
.galeri-desc {
  font-size: 0.875rem;
  color: #64748b;
  margin-bottom: 1rem;
  line-height: 1.5;
  flex: 1;
}
.galeri-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 0.75rem;
  border-top: 1px solid rgba(0,0,0,0.08);
}
.galeri-meta .badge {
  font-size: 0.7rem;
  padding: 4px 10px;
  font-weight: 600;
}
</style>
@endpush
