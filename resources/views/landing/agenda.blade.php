@extends('landing.layout.app')

@section('title', 'Agenda Kegiatan - Desa Cimeong')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #10b981, #059669);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-calendar-event"></i> Kalender Desa</span>
        <h1 class="hero-title text-white mt-3">Jadwal & Agenda Kegiatan</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Ikuti setiap kegiatan dan acara yang diadakan di Desa Cimeong</p>
      </div>
    </div>
  </div>
</section>

<!-- AGENDA LIST -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($agenda as $ag)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
          <div class="cause-card h-100">
            @if($ag->gambar)
              <div class="cause-img">
                <img src="{{ Str::startsWith($ag->gambar, 'http') ? $ag->gambar : asset('storage/' . $ag->gambar) }}" alt="{{ $ag->judul }}">
              </div>
            @endif
            <div class="cause-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                @if($ag->status == 'akan')
                  <span class="badge bg-warning text-dark">Akan Datang</span>
                @else
                  <span class="badge bg-success">Terlaksana</span>
                @endif
                <small class="text-muted">
                  <i class="bi bi-calendar3"></i> {{ $ag->tanggal_mulai ? $ag->tanggal_mulai->format('d M Y') : '-' }}
                </small>
              </div>
              <h5 class="cause-title">{{ $ag->judul }}</h5>
              <p class="text-muted small mb-2">
                <i class="bi bi-geo-alt-fill text-danger"></i> {{ $ag->lokasi }}
              </p>
              @if($ag->tanggal_mulai && $ag->tanggal_selesai)
                <p class="text-muted small mb-2">
                  <i class="bi bi-clock-fill text-primary"></i> 
                  {{ $ag->tanggal_mulai->format('H:i') }} - {{ $ag->tanggal_selesai->format('H:i') }} WIB
                </p>
              @endif
              <p class="cause-text">{{ Str::limit($ag->deskripsi, 100) }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center py-5">
            <i class="bi bi-calendar-x" style="font-size: 4rem; color: var(--clr-text-muted);"></i>
            <h4 class="mt-3">Belum Ada Agenda</h4>
            <p class="text-muted">Agenda kegiatan akan ditampilkan di halaman ini</p>
          </div>
        </div>
      @endforelse
    </div>

    @if($agenda->hasPages())
      <div class="mt-5 d-flex justify-content-center">
        {{ $agenda->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
</section>

@endsection
