@extends('landing.layout.app')

@section('title', 'Pengumuman Resmi - Desa Cimeong')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #f59e0b, #d97706);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-megaphone"></i> Informasi Penting</span>
        <h1 class="hero-title text-white mt-3">Pengumuman Resmi Desa</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Pemberitahuan dan himbauan pemerintah desa untuk seluruh warga</p>
      </div>
    </div>
  </div>
</section>

<!-- PENGUMUMAN LIST -->
<section class="section-pad">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        @forelse($pengumuman as $p)
          <div class="cause-card mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}" style="border-left: 5px solid {{ $p->status == 'aktif' ? 'var(--clr-primary)' : '#6b7280' }};">
            <div class="cause-body">
              <div class="d-flex justify-content-between align-items-start mb-3">
                @if($p->status == 'aktif')
                  <span class="badge bg-success">Pengumuman Aktif</span>
                @else
                  <span class="badge bg-secondary">Arsip</span>
                @endif
                <small class="text-muted">
                  <i class="bi bi-calendar-range"></i> 
                  {{ $p->tanggal_mulai ? $p->tanggal_mulai->format('d M Y') : '' }} - 
                  {{ $p->tanggal_selesai ? $p->tanggal_selesai->format('d M Y') : 'Seterusnya' }}
                </small>
              </div>
              
              <h4 class="cause-title">{{ $p->judul }}</h4>

              @if($p->gambar)
                <div class="mb-3" style="border-radius: var(--radius); overflow: hidden; max-height: 300px;">
                  <img src="{{ Str::startsWith($p->gambar, 'http') ? $p->gambar : asset('storage/' . $p->gambar) }}" 
                       alt="{{ $p->judul }}" 
                       style="width: 100%; object-fit: cover;">
                </div>
              @endif

              <div style="white-space: pre-line; line-height: 1.7;">{{ $p->isi }}</div>
            </div>
          </div>
        @empty
          <div class="text-center py-5">
            <i class="bi bi-bell-slash" style="font-size: 4rem; color: var(--clr-text-muted);"></i>
            <h4 class="mt-3">Belum Ada Pengumuman</h4>
            <p class="text-muted">Pengumuman resmi desa akan ditampilkan di halaman ini</p>
          </div>
        @endforelse

        @if($pengumuman->hasPages())
          <div class="mt-4 d-flex justify-content-center">
            {{ $pengumuman->links('pagination::bootstrap-5') }}
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
