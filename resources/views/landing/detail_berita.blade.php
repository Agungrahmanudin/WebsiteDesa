@extends('landing.layout.app')

@section('title', $berita->judul . ' - Berita Desa Cimeong')

@section('content')

<!-- BREADCRUMB -->
<section style="padding: 140px 0 40px; background: var(--clr-bg);">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita</a></li>
        <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 40) }}</li>
      </ol>
    </nav>
  </div>
</section>

<!-- POST CONTENT -->
<section class="section-pad pt-0">
  <div class="container">
    <div class="row g-5">
      <!-- Main Content -->
      <div class="col-lg-8">
        <article class="post-single" data-aos="fade-up">
          <span class="badge bg-primary mb-3">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
          <h1 class="post-title">{{ $berita->judul }}</h1>
          <div class="post-meta">
            <span><i class="bi bi-calendar3"></i> {{ $berita->created_at->format('d F Y') }}</span>
            <span><i class="bi bi-person"></i> Admin Desa</span>
          </div>

          @if($berita->gambar)
            <div class="post-featured-image">
              <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 100%; border-radius: var(--radius); margin: 30px 0;">
            </div>
          @endif

          <div class="post-content" style="font-size: 1.05rem; line-height: 1.8; color: var(--clr-text);">
            {!! nl2br(e($berita->isi)) !!}
          </div>

          @if($berita->tags->count() > 0)
            <div class="post-tags mt-4">
              <i class="bi bi-tags me-2"></i>
              @foreach($berita->tags as $t)
                <a href="#" class="badge bg-light text-dark me-1">#{{ $t->nama_tag }}</a>
              @endforeach
            </div>
          @endif

          <!-- Share -->
          <div class="post-share mt-5 pt-4" style="border-top: 1px solid var(--clr-bg);">
            <h6 class="mb-3">Bagikan Artikel:</h6>
            <div class="d-flex gap-2">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.detail', $berita->slug)) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-facebook"></i> Facebook
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.detail', $berita->slug)) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="btn btn-sm btn-outline-info">
                <i class="bi bi-twitter"></i> Twitter
              </a>
              <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . route('berita.detail', $berita->slug)) }}" target="_blank" class="btn btn-sm btn-outline-success">
                <i class="bi bi-whatsapp"></i> WhatsApp
              </a>
            </div>
          </div>
        </article>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Berita Lainnya -->
        <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="100">
          <h5 class="widget-title">Berita Lainnya</h5>
          @foreach($beritaLainnya as $bl)
            <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom: 1px solid var(--clr-bg);">
              <div style="width: 80px; height: 80px; flex-shrink: 0; border-radius: var(--radius-sm); overflow: hidden;">
                @if($bl->gambar)
                  <img src="{{ Str::startsWith($bl->gambar, 'http') ? $bl->gambar : asset('storage/' . $bl->gambar) }}" alt="{{ $bl->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                  <div style="width: 100%; height: 100%; background: var(--clr-bg);"></div>
                @endif
              </div>
              <div class="flex-grow-1">
                <small class="text-muted d-block mb-1">{{ $bl->created_at->format('d M Y') }}</small>
                <h6 class="mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                  <a href="{{ route('berita.detail', $bl->slug) }}" style="color: var(--clr-text);">{{ Str::limit($bl->judul, 60) }}</a>
                </h6>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Kategori -->
        <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="200">
          <h5 class="widget-title">Kategori</h5>
          <div class="list-group">
            @foreach($kategoriList as $k)
              <a href="{{ route('berita', ['kategori' => $k->slug]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                {{ $k->nama_kategori }}
                <span class="badge bg-primary rounded-pill">{{ $k->berita_count }}</span>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
.post-title {
  font-family: var(--font-display);
  font-size: 2.2rem;
  font-weight: 800;
  line-height: 1.3;
  margin-bottom: 20px;
}
.post-meta {
  display: flex;
  gap: 20px;
  color: var(--clr-text-muted);
  font-size: 0.9rem;
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--clr-bg);
}
.sidebar-widget {
  background: var(--clr-surface);
  padding: 30px;
  border-radius: var(--radius);
  margin-bottom: 30px;
  box-shadow: var(--shadow-soft);
}
.widget-title {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.2rem;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid var(--clr-primary);
}
</style>
@endpush
