@extends('landing.layout.app')

@section('title', 'Berita Desa - Desa Cimeong')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, var(--clr-primary), var(--clr-primary-dark));">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-newspaper"></i> Informasi Terkini</span>
        <h1 class="hero-title text-white mt-3">Berita & Artikel Desa Cimeong</h1>
        <p class="hero-lead text-white mt-3 opacity-75">Dapatkan informasi terbaru seputar kegiatan, pembangunan, dan perkembangan Desa Cimeong</p>
      </div>
    </div>
  </div>
</section>

<!-- BERITA LIST -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($berita as $b)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
          <div class="berita-card h-100">
            <div class="berita-img">
              @if($b->gambar)
                <img src="{{ Str::startsWith($b->gambar, 'http') ? $b->gambar : asset('storage/' . $b->gambar) }}" alt="{{ $b->judul }}">
              @else
                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&fit=crop" alt="{{ $b->judul }}">
              @endif
              <span class="berita-kategori">{{ $b->kategori->nama_kategori ?? 'Umum' }}</span>
            </div>
            <div class="berita-body">
              <div class="berita-meta">
                <span><i class="bi bi-calendar3"></i> {{ $b->created_at->format('d M Y') }}</span>
              </div>
              <h5 class="berita-title">
                <a href="{{ route('berita.detail', $b->slug) }}">{{ $b->judul }}</a>
              </h5>
              <p class="berita-excerpt">{{ Str::limit(strip_tags($b->isi), 100) }}</p>
              @if($b->tags->count() > 0)
                <div class="berita-tags mb-3">
                  @foreach($b->tags->take(2) as $t)
                    <span class="badge bg-light text-dark border">#{{ $t->nama_tag }}</span>
                  @endforeach
                </div>
              @endif
              <a href="{{ route('berita.detail', $b->slug) }}" class="btn btn-sm btn-outline-primary w-100 mt-auto">
                <i class="bi bi-book-half"></i> Baca Selengkapnya
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center py-5">
            <i class="bi bi-newspaper" style="font-size: 4rem; color: var(--clr-text-muted);"></i>
            <h4 class="mt-3">Belum Ada Berita</h4>
            <p class="text-muted">Berita terbaru akan ditampilkan di halaman ini</p>
          </div>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($berita->hasPages())
      <div class="mt-5 d-flex justify-content-center">
        {{ $berita->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

@endsection


@push('styles')
<style>
/* Berita Card Styles - Clean & Modern */
.berita-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  display: flex;
  flex-direction: column;
  border: 1px solid #e2e8f0;
}

.berita-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.berita-img {
  position: relative;
  overflow: hidden;
  height: 220px;
  background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
}

.berita-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  transition: transform 0.5s ease;
}

.berita-card:hover .berita-img img {
  transform: scale(1.1);
}

.berita-kategori {
  position: absolute;
  top: 12px;
  left: 12px;
  background: var(--clr-primary);
  color: #fff;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.berita-body {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.berita-meta {
  display: flex;
  gap: 1rem;
  font-size: 0.8rem;
  color: #64748b;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid #e2e8f0;
}

.berita-meta i {
  margin-right: 4px;
}

.berita-title {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.1rem;
  margin-bottom: 0.75rem;
  line-height: 1.4;
}

.berita-title a {
  color: var(--clr-heading);
  text-decoration: none;
  transition: color 0.3s ease;
}

.berita-title a:hover {
  color: var(--clr-primary);
}

.berita-excerpt {
  font-size: 0.9rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 1rem;
  flex: 1;
}

.berita-tags {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.berita-tags .badge {
  font-size: 0.7rem;
  padding: 4px 10px;
  font-weight: 500;
}

.berita-card .btn {
  border-width: 2px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.berita-card .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Page Header Improvements */
.page-header .hero-lead {
  text-align: center;
  margin-left: auto;
  margin-right: auto;
  max-width: 700px;
}
</style>
@endpush
