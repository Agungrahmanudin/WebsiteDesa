@extends('landing.layout.app')

@section('title', 'Galeri Desa - ' . ucwords($kontakDesa->nama_desa ?? 'Desa'))

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-images"></i> Dokumentasi</span>
        <h1 class="hero-title text-white mt-3">Galeri Foto & Video</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Potret kebersamaan masyarakat dan pembangunan {{ ucwords($kontakDesa->nama_desa ?? 'Desa') }}</p>
      </div>
    </div>
  </div>
</section>

<!-- GALERI GRID -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($galeri as $g)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
          <div class="galeri-card-custom h-100">
            @if($g->kategori == 'foto')
              <div class="galeri-img-custom" style="background-image: url('{{ Str::startsWith($g->file, 'http') ? $g->file : asset('storage/' . $g->file) }}');">
                <span class="badge bg-dark galeri-badge">{{ ucfirst($g->kategori) }}</span>
              </div>
            @else
              <div class="galeri-img-custom" style="background: var(--clr-primary);">
                <div class="d-flex align-items-center justify-content-center h-100">
                  <i class="bi bi-play-circle text-white" style="font-size: 4rem;"></i>
                </div>
                <span class="badge bg-danger galeri-badge">{{ ucfirst($g->kategori) }}</span>
              </div>
            @endif
            <div class="galeri-body-custom">
              <h5 class="galeri-title-custom">{{ $g->judul }}</h5>
              <p class="galeri-text-custom">{{ Str::limit($g->keterangan, 80) ?: 'Dokumentasi kegiatan desa' }}</p>
              <a href="{{ route('galeri.detail', $g->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-auto">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center py-5">
            <i class="bi bi-camera" style="font-size: 4rem; color: var(--clr-text-muted);"></i>
            <h4 class="mt-3">Belum Ada Galeri</h4>
            <p class="text-muted">Foto dan video akan ditampilkan di halaman ini</p>
          </div>
        </div>
      @endforelse
    </div>

    @if($galeri->hasPages())
      <div class="mt-5 d-flex justify-content-center">
        {{ $galeri->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

@endsection


@push('styles')
<style>
/* Galeri Card Custom - Full Cover dengan Background Image */
.galeri-card-custom {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  display: flex;
  flex-direction: column;
  border: 1px solid #e2e8f0;
}

.galeri-card-custom:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

.galeri-img-custom {
  position: relative;
  height: 250px;
  width: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  transition: transform 0.5s ease;
  overflow: hidden;
}

.galeri-card-custom:hover .galeri-img-custom {
  transform: scale(1.05);
}

.galeri-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  z-index: 10;
  font-weight: 600;
  font-size: 0.75rem;
  padding: 6px 14px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.galeri-body-custom {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  background: #fff;
}

.galeri-title-custom {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.1rem;
  margin-bottom: 0.75rem;
  color: var(--clr-heading);
  line-height: 1.4;
}

.galeri-text-custom {
  font-size: 0.9rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 1rem;
  flex: 1;
}

.galeri-card-custom .btn {
  border-width: 2px;
  font-weight: 600;
  transition: all 0.3s ease;
}

.galeri-card-custom .btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}
</style>
@endpush
