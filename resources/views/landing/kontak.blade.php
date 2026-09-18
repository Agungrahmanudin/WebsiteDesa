@extends('landing.layout.app')

@section('title', 'Hubungi Kami - ' . ($kontakDesa->nama_desa ?? 'Desa'))

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #ec4899, #db2777);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-chat-dots"></i> Hubungi Kami</span>
        <h1 class="hero-title text-white mt-3">Saluran Komunikasi Desa</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Sampaikan aspirasi, kritik, dan saran untuk pembangunan {{ $kontakDesa->nama_desa ?? 'Desa' }}</p>
      </div>
    </div>
  </div>
</section>

<!-- KONTAK CONTENT -->
<section class="section-pad">
  <div class="container">
    <div class="row g-5">
      <!-- Info Kontak -->
      <div class="col-lg-5" data-aos="fade-right">
        <div class="contact-card h-100">
          <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom: 2px solid var(--clr-bg);">
            <div style="width: 50px; height: 50px; background: var(--clr-primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-telephone" style="font-size: 1.5rem; color: var(--clr-primary);"></i>
            </div>
            <div>
              <h3 class="mb-1" style="font-family: var(--font-display); font-weight: 700;">Kontak Resmi</h3>
              <p class="text-muted mb-0 small">Hubungi kami melalui:</p>
            </div>
          </div>

          <div class="mb-4">
            <div class="d-flex gap-3 align-items-start">
              <div style="width: 45px; height: 45px; background: var(--clr-primary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-geo-alt-fill" style="color: var(--clr-primary);"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">Alamat Balai Desa</h6>
                <p class="text-muted mb-0">{{ $kontak->alamat ?? '' }}</p>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="d-flex gap-3 align-items-start">
              <div style="width: 45px; height: 45px; background: var(--clr-secondary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-telephone-fill" style="color: var(--clr-secondary);"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
                <p class="text-muted mb-0">{{ $kontak->no_telepon ?? '-' }}</p>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="d-flex gap-3 align-items-start">
              <div style="width: 45px; height: 45px; background: var(--clr-accent-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-envelope-fill" style="color: var(--clr-accent);"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">Email Resmi Desa</h6>
                <p class="text-muted mb-0">{{ $kontak->email ?? '-' }}</p>
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h6 class="fw-bold mb-3"><i class="bi bi-clock"></i> Jam Pelayanan</h6>
          <div class="p-3 mb-3" style="background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 12px; color: white;">
            <p class="mb-2 small opacity-90">Pelayanan administrasi warga dibuka pada:</p>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="fw-semibold">Senin - Kamis</span>
              <span class="badge bg-white text-primary">{{ $kontak->jadwal_senin_kamis ?? '08.00 - 15.00' }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="fw-semibold">Jumat</span>
              <span class="badge bg-white text-primary">{{ $kontak->jadwal_jumat ?? '08.00 - 11.30' }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-semibold">Sabtu & Minggu</span>
              <span class="badge bg-danger">{{ $kontak->jadwal_weekend ?? 'Libur' }}</span>
            </div>
          </div>

          <hr class="my-4">

          <h6 class="fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.05em;">Media Sosial Resmi:</h6>
          <div class="d-flex gap-2">
            @if(!empty($kontak->facebook ?? ''))
              <a href="{{ $kontak->facebook }}" target="_blank" class="footer-social">
                <i class="bi bi-facebook"></i>
              </a>
            @endif
            @if(!empty($kontak->instagram ?? ''))
              <a href="{{ $kontak->instagram }}" target="_blank" class="footer-social">
                <i class="bi bi-instagram"></i>
              </a>
            @endif
            @if(!empty($kontak->youtube ?? ''))
              <a href="{{ $kontak->youtube }}" target="_blank" class="footer-social">
                <i class="bi bi-youtube"></i>
              </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Form Masukan -->
      <div class="col-lg-7" data-aos="fade-left">
        <div class="contact-card">
          <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom: 2px solid var(--clr-bg);">
            <div style="width: 50px; height: 50px; background: var(--clr-primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-chat-left-text" style="font-size: 1.5rem; color: var(--clr-primary);"></i>
            </div>
            <div>
              <h3 class="mb-1" style="font-family: var(--font-display); font-weight: 700;">Kirim Masukan & Aduan</h3>
              <p class="text-muted mb-0 small">Aspirasi Anda sangat penting bagi kami</p>
            </div>
          </div>

          <form action="#" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Lengkap</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama Anda" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor WhatsApp / Email</label>
              <input type="text" class="form-control form-control-lg" 
                     placeholder="08xxxxxxxxxx atau email@gmail.com" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Isi Pesan / Aduan</label>
              <textarea rows="5" class="form-control" 
                        placeholder="Tuliskan aspirasi, kritik, atau saran untuk kemajuan {{ $kontakDesa->nama_desa ?? 'desa' }}..." required></textarea>
            </div>

            <button type="button" 
                    onclick="alert('Terima kasih! Pesan Anda telah diteruskan ke Pemerintah {{ $kontakDesa->nama_desa ?? 'Desa' }}.')" 
                    class="btn-hw-primary w-100 py-3 justify-content-center">
              <i class="bi bi-send"></i> Kirim Aspirasi
            </button>
          </form>

          <div class="alert alert-info mt-4 mb-0">
            <i class="bi bi-shield-check me-2"></i>
            <strong>Keamanan Data:</strong> Informasi Anda dijaga kerahasiaannya sesuai regulasi perlindungan data pribadi.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
:root {
  --clr-accent: #ef4444;
  --clr-accent-light: #fee2e2;
}
.footer-social {
  width: 45px;
  height: 45px;
  background: var(--clr-bg);
  border-radius: 10px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: var(--clr-text);
  transition: all 0.3s var(--ease);
}
.footer-social:hover {
  background: var(--clr-primary);
  color: white;
  transform: translateY(-3px);
}
</style>
@endpush
