@extends('landing.layout.app')

@section('title', $item->judul . ' - Galeri ' . ($kontakDesa->nama_desa ?? 'Desa'))
@section('description', $item->keterangan ?: 'Dokumentasi kegiatan dan momen penting di ' . ($kontakDesa->nama_desa ?? 'desa'))

@section('content')

<!-- Breadcrumb -->
<section class="py-5" style="background: linear-gradient(135deg, var(--clr-primary), var(--clr-primary-dark)); margin-top: 72px;">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none"><i class="bi bi-house-door"></i> Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('galeri') }}" class="text-white text-decoration-none">Galeri</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($item->judul, 50) }}</li>
      </ol>
    </nav>
    <h1 class="text-white mt-3 mb-0 fw-bold">{{ $item->judul }}</h1>
  </div>
</section>

<!-- Detail Content -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      <!-- Main Content -->
      <div class="col-lg-8">
        <div class="bg-white rounded-4 shadow-sm overflow-hidden" data-aos="fade-up">
          <!-- Media Display -->
          @if($item->kategori == 'foto')
            <div class="position-relative" style="max-height: 600px; overflow: hidden; background: #f8f9fa;">
              <img src="{{ Str::startsWith($item->file, 'http') ? $item->file : asset('storage/' . $item->file) }}" 
                   alt="{{ $item->judul }}" 
                   class="w-100 h-auto"
                   style="object-fit: contain; max-height: 600px;">
            </div>
          @else
            <!-- Video Embed -->
            <div class="ratio ratio-16x9 bg-dark">
              @php
                // Parse YouTube URL
                $videoId = null;
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $item->file, $match)) {
                    $videoId = $match[1];
                }
              @endphp
              @if($videoId)
                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
                        title="{{ $item->judul }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                        class="w-100 h-100"></iframe>
              @else
                <div class="d-flex align-items-center justify-content-center h-100 text-white">
                  <div class="text-center">
                    <i class="bi bi-play-circle-fill" style="font-size: 5rem;"></i>
                    <p class="mt-3">
                      <a href="{{ $item->file }}" target="_blank" class="btn btn-light">
                        <i class="bi bi-box-arrow-up-right"></i> Buka Video
                      </a>
                    </p>
                  </div>
                </div>
              @endif
            </div>
          @endif

          <!-- Content Body -->
          <div class="p-4">
            <!-- Meta Info -->
            <div class="d-flex flex-wrap gap-3 mb-4 pb-3 border-bottom">
              <span class="badge {{ $item->kategori == 'foto' ? 'bg-primary' : 'bg-danger' }} px-3 py-2">
                <i class="bi bi-{{ $item->kategori == 'foto' ? 'image' : 'camera-video' }}"></i> 
                {{ ucfirst($item->kategori) }}
              </span>
              <span class="text-muted d-flex align-items-center gap-2">
                <i class="bi bi-calendar3"></i>
                {{ $item->created_at->format('d F Y') }}
              </span>
              <span class="text-muted d-flex align-items-center gap-2">
                <i class="bi bi-clock"></i>
                {{ $item->created_at->format('H:i') }} WIB
              </span>
            </div>

            <!-- Title -->
            <h2 class="fw-bold mb-3" style="color: var(--clr-heading); line-height: 1.4;">{{ $item->judul }}</h2>

            <!-- Description -->
            @if($item->keterangan)
              <div class="content-text" style="font-size: 1.05rem; line-height: 1.8; color: #475569;">
                {!! nl2br(e($item->keterangan)) !!}
              </div>
            @else
              <p class="text-muted fst-italic">Tidak ada deskripsi.</p>
            @endif

            <!-- Share Buttons -->
            <div class="mt-4 pt-4 border-top">
              <h6 class="mb-3 fw-bold">Bagikan:</h6>
              <div class="d-flex gap-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('galeri.detail', $item->id)) }}" 
                   target="_blank" 
                   class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-facebook"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('galeri.detail', $item->id)) }}&text={{ urlencode($item->judul) }}" 
                   target="_blank" 
                   class="btn btn-outline-info btn-sm">
                  <i class="bi bi-twitter"></i> Twitter
                </a>
                <a href="https://wa.me/?text={{ urlencode($item->judul . ' - ' . route('galeri.detail', $item->id)) }}" 
                   target="_blank" 
                   class="btn btn-outline-success btn-sm">
                  <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="mt-4 d-flex gap-3 flex-wrap">
          <a href="{{ route('galeri') }}" class="btn btn-lg btn-outline-secondary d-inline-flex align-items-center gap-2" style="font-weight: 600; padding: 12px 24px; border-width: 2px;">
            <i class="bi bi-arrow-left" style="font-size: 1.2rem;"></i> Kembali ke Galeri
          </a>
          @if($item->kategori == 'foto')
            <a href="{{ Str::startsWith($item->file, 'http') ? $item->file : asset('storage/' . $item->file) }}" 
               download 
               class="btn btn-lg btn-primary d-inline-flex align-items-center gap-2" style="font-weight: 600; padding: 12px 24px;">
              <i class="bi bi-download" style="font-size: 1.2rem;"></i> Unduh Foto
            </a>
          @endif
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Galeri Lainnya -->
        @if($galeriLainnya->count() > 0)
          <div class="bg-white rounded-4 shadow-sm p-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <h5 class="fw-bold mb-4">
              <i class="bi bi-images text-primary me-2"></i>Galeri Lainnya
            </h5>
            <div class="d-flex flex-column gap-3">
              @foreach($galeriLainnya as $g)
                <a href="{{ route('galeri.detail', $g->id) }}" class="text-decoration-none">
                  <div class="d-flex gap-3 p-2 rounded hover-bg-light transition" style="border: 1px solid #e2e8f0;">
                    <div class="flex-shrink-0" style="width: 80px; height: 80px; border-radius: 8px; overflow: hidden; background: #f1f5f9;">
                      @if($g->kategori == 'foto')
                        <img src="{{ Str::startsWith($g->file, 'http') ? $g->file : asset('storage/' . $g->file) }}" 
                             alt="{{ $g->judul }}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                      @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark text-white">
                          <i class="bi bi-play-circle-fill fs-2"></i>
                        </div>
                      @endif
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 fw-semibold" style="font-size: 0.9rem; color: var(--clr-heading); line-height: 1.3;">
                        {{ Str::limit($g->judul, 50) }}
                      </h6>
                      <p class="text-muted mb-1" style="font-size: 0.75rem;">
                        <i class="bi bi-calendar3"></i> {{ $g->created_at->format('d M Y') }}
                      </p>
                      <span class="badge {{ $g->kategori == 'foto' ? 'bg-primary' : 'bg-danger' }}" style="font-size: 0.65rem;">
                        {{ ucfirst($g->kategori) }}
                      </span>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
            <a href="{{ route('galeri') }}" class="btn btn-outline-primary w-100 mt-3">
              Lihat Semua Galeri <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        @endif

        <!-- Info Box -->
        <div class="bg-gradient rounded-4 shadow-sm p-4 text-white" 
             style="background: linear-gradient(135deg, var(--clr-primary), var(--clr-primary-dark));"
             data-aos="fade-up" 
             data-aos-delay="200">
          <h6 class="fw-bold mb-3">
            <i class="bi bi-info-circle me-2"></i>Tentang Galeri
          </h6>
          <p class="mb-0" style="font-size: 0.9rem; line-height: 1.6;">
            Galeri ini berisi dokumentasi kegiatan dan momen penting di Desa Cimeong. Kami berusaha mendokumentasikan setiap kegiatan untuk transparansi dan kenangan bersama.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
.hover-bg-light:hover {
  background: #f8fafc !important;
  transform: translateX(5px);
}
.transition {
  transition: all 0.3s ease;
}
.content-text {
  text-align: justify;
}
</style>
@endpush
