@extends('landing.layout.app')

@section('title', 'Profil Desa - Desa Cimeong')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #6366f1, #4f46e5);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-building"></i> Tentang Kami</span>
        <h1 class="hero-title text-white mt-3">Profil Pemerintah Desa</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Mengenal lebih dekat sejarah, visi, misi, dan struktur organisasi Desa Cimeong</p>
      </div>
    </div>
  </div>
</section>

<!-- VISI MISI -->
<section class="section-pad">
  <div class="container">
    <div class="row g-5">
      <!-- Visi & Misi -->
      <div class="col-lg-6" data-aos="fade-right">
        <div class="contact-card h-100">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: var(--clr-primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-bullseye" style="font-size: 1.5rem; color: var(--clr-primary);"></i>
            </div>
            <h3 style="font-family: var(--font-display); font-weight: 700;">Visi & Misi</h3>
          </div>
          
          <h6 class="text-uppercase fw-bold text-primary mb-2" style="font-size: 0.85rem; letter-spacing: 0.05em;">VISI</h6>
          <div class="alert alert-primary mb-4" style="border-left: 4px solid var(--clr-primary);">
            <p class="mb-0 fst-italic fw-semibold">
              "{{ !empty($kontak->visi) ? $kontak->visi : 'Terwujudnya Desa Cimeong yang Mandiri, Sejahtera, Berakhlak Mulia, dan Transparan Berbasis Potensi Lokal dan Teknologi Informasi.' }}"
            </p>
          </div>

          <h6 class="text-uppercase fw-bold text-primary mb-3" style="font-size: 0.85rem; letter-spacing: 0.05em;">MISI</h6>
          @php
            $misiItems = [];
            if (!empty($kontak->misi)) {
                $lines = explode("\n", $kontak->misi);
                foreach ($lines as $line) {
                    $clean = preg_replace('/^(\d+[\.\)]|\-|\*)\s*/', '', trim($line));
                    if (!empty($clean)) {
                        $misiItems[] = $clean;
                    }
                }
            }
          @endphp
          @if(count($misiItems) > 0)
            <ol class="mb-0" style="line-height: 1.8;">
              @foreach($misiItems as $item)
                <li class="mb-2">{{ $item }}</li>
              @endforeach
            </ol>
          @else
            <ol class="mb-0" style="line-height: 1.8;">
              <li class="mb-2">Meningkatkan kualitas pelayanan administrasi dan birokrasi pemerintahan desa yang cepat, ramah, dan bebas pungli.</li>
              <li class="mb-2">Mendorong pembangunan infrastruktur sarana prasarana pertanian dan jalan pemukiman secara merata dan berkelanjutan.</li>
              <li class="mb-2">Mengembangkan Badan Usaha Milik Desa (BUMDes) dan kemitraan UMKM guna menopang perekonomian masyarakat.</li>
              <li class="mb-2">Meningkatkan kualitas sumber daya manusia (SDM) melalui program pembinaan generasi muda, pendidikan, dan kesehatan.</li>
              <li>Melestarikan nilai-nilai kearifan lokal, kerukunan gotong royong, dan kegiatan keagamaan di lingkungan warga.</li>
            </ol>
          @endif
        </div>
      </div>

      <!-- Sejarah -->
      <div class="col-lg-6" data-aos="fade-left">
        <div class="contact-card h-100">
          <div class="d-flex align-items-center gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: var(--clr-secondary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-book" style="font-size: 1.5rem; color: var(--clr-secondary);"></i>
            </div>
            <h3 style="font-family: var(--font-display); font-weight: 700;">Sejarah Singkat</h3>
          </div>
          <div class="sejarah-content" style="line-height: 1.8;">
            @if(!empty($kontak->sejarah))
              {!! nl2br(e($kontak->sejarah)) !!}
            @else
              <p class="mb-3">
                Desa Cimeong merupakan salah satu desa yang sarat akan kekayaan sejarah dan budaya agraris. Nama Cimeong secara turun-temurun berasal dari kata mata air jernih yang menjadi sumber kehidupan masyarakat petani di kawasan perbukitan sejak dahulu.
              </p>
              <p>
                Seiring perkembangan zaman, Desa Cimeong kini terus berbenah menjadi desa modern tanpa melupakan akar tradisi gotong royong warga. Melalui digitalisasi layanan publik, desa ini siap menyongsong era keterbukaan informasi dan kemudahan akses bagi seluruh warganya.
              </p>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Statistik & Kontak -->
    <div class="row g-4 mt-4">
      <div class="col-lg-12" data-aos="fade-up">
        <div class="contact-card">
          <div class="row g-0">
            <!-- Statistik Penduduk -->
            <div class="col-md-4 text-center p-4">
              <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                <div style="width: 40px; height: 40px; background: var(--clr-primary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                  <i class="bi bi-pie-chart" style="font-size: 1.25rem; color: var(--clr-primary);"></i>
                </div>
                <h5 class="mb-0 fw-bold">Statistik Penduduk</h5>
              </div>
              <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted">Total Penduduk</span>
                <span class="fw-bold text-primary">{{ number_format($totalPenduduk) }} Jiwa</span>
              </div>
              <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted">Laki-Laki</span>
                <span class="fw-bold">{{ number_format($totalLaki) }} Jiwa</span>
              </div>
              <div class="d-flex justify-content-between py-2">
                <span class="text-muted">Perempuan</span>
                <span class="fw-bold">{{ number_format($totalPerempuan) }} Jiwa</span>
              </div>
            </div>

            <!-- Garis Pemisah -->
            <div class="col-md-1 d-flex align-items-center justify-content-center">
              <div style="width: 2px; height: 80%; background: #e5e7eb;"></div>
            </div>

            <!-- Kontak Balai Desa -->
            <div class="col-md-7 p-4">
              <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width: 40px; height: 40px; background: var(--clr-success-light); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                  <i class="bi bi-telephone" style="font-size: 1.25rem; color: var(--clr-success);"></i>
                </div>
                <h5 class="mb-0 fw-bold">Kontak Balai Desa</h5>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-geo-alt-fill text-danger mt-1" style="font-size: 1.1rem;"></i>
                    <div>
                      <small class="text-muted d-block mb-1">Alamat</small>
                      <span class="fw-semibold">{{ $kontak->alamat ?? 'Jl. Raya Desa Cimeong, Kec. Banjaran, Majalengka, Jawa Barat' }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-telephone-fill text-success mt-1" style="font-size: 1.1rem;"></i>
                    <div>
                      <small class="text-muted d-block mb-1">Telepon</small>
                      <span class="fw-semibold">{{ $kontak->no_telepon ?? '081234567890' }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-envelope-fill text-info mt-1" style="font-size: 1.1rem;"></i>
                    <div>
                      <small class="text-muted d-block mb-1">Email</small>
                      <span class="fw-semibold">{{ $kontak->email ?? 'pemdes@cimeong.desa.id' }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- APARATUR DESA -->
<section class="section-pad" style="background: var(--clr-surface);">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-7" data-aos="fade-up">
        <span class="eyebrow"><i class="bi bi-people"></i> Tim Kami</span>
        <h2 class="section-title mt-3">Struktur Organisasi & Aparatur</h2>
        <p class="section-sub mt-3">Perangkat Desa Cimeong yang melayani dengan dedikasi</p>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      @foreach($perangkat as $p)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
          <div class="vol-card text-center">
            <div class="vol-img mx-auto" style="width: 180px; height: 180px;">
              @if($p->foto)
                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" style="border-radius: 50%; width: 100%; height: 100%; object-fit: cover; border: 4px solid var(--clr-primary);">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nama) }}&background=0d6efd&color=fff&size=200" alt="{{ $p->nama }}" style="border-radius: 50%; width: 100%; height: 100%; border: 4px solid var(--clr-primary);">
              @endif
            </div>
            <h5 class="vol-name mt-3 mb-2" style="font-size: 1.1rem;">{{ $p->nama }}</h5>
            <p class="vol-role text-primary fw-semibold mb-0" style="font-size: 0.95rem;">{{ $p->jabatan }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
.sidebar-widget {
  background: var(--clr-surface);
  padding: 25px;
  border-radius: var(--radius);
  margin-bottom: 25px;
  box-shadow: var(--shadow-soft);
}
.widget-title {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.1rem;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid var(--clr-primary);
}
</style>
@endpush
