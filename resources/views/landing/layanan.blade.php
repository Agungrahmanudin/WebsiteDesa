@extends('landing.layout.app')

@section('title', 'Layanan Surat Online - Desa Cimeong')

@section('content')

<!-- PAGE HEADER -->
<section class="page-header" style="padding: 160px 0 80px; background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow text-white" style="background: rgba(255,255,255,0.2);"><i class="bi bi-file-earmark-text"></i> Pelayanan Digital</span>
        <h1 class="hero-title text-white mt-3">Permohonan Surat Online</h1>
        <p class="hero-lead text-white mt-3 opacity-75" style="text-align: center; margin-left: auto; margin-right: auto; max-width: 700px;">Ajukan surat administrasi tanpa harus antre di kantor desa</p>
      </div>
    </div>
  </div>
</section>

<!-- LAYANAN FORM -->
<section class="section-pad">
  <div class="container">
    <div class="row g-5">
      <!-- Form -->
      <div class="col-lg-8" data-aos="fade-right">
        <div class="contact-card">
          <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom: 2px solid var(--clr-bg);">
            <div style="width: 50px; height: 50px; background: var(--clr-primary-light); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-file-earmark-text" style="font-size: 1.5rem; color: var(--clr-primary);"></i>
            </div>
            <div>
              <h3 class="mb-1" style="font-family: var(--font-display); font-weight: 700;">Formulir Permohonan</h3>
              <p class="text-muted mb-0 small">Isi data dengan lengkap dan benar</p>
            </div>
          </div>

          @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4">
              <i class="bi bi-check-circle-fill me-2"></i>
              {{ session('success') }}
            </div>
          @endif

          <form action="{{ route('layanan.kirim') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
              <label class="form-label fw-semibold">Pilih Jenis Layanan Surat <span class="text-danger">*</span></label>
              <select name="layanan_id" class="form-select form-select-lg" required>
                <option value="">-- Pilih Jenis Surat --</option>
                @foreach($layananList as $lay)
                  <option value="{{ $lay->id }}" {{ old('layanan_id') == $lay->id ? 'selected' : '' }}>
                    {{ $lay->nama_layanan }}
                  </option>
                @endforeach
              </select>
              @error('layanan_id')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_pemohon" class="form-control form-control-lg" 
                       value="{{ old('nama_pemohon', auth()->user()->name ?? '') }}" 
                       placeholder="Sesuai KTP" required>
                @error('nama_pemohon')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" class="form-control form-control-lg" 
                       value="{{ old('nik', auth()->user()->profile->nik ?? '') }}" 
                       placeholder="16 digit NIK" required>
                @error('nik')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
              <textarea name="alamat" rows="2" class="form-control" 
                        placeholder="Contoh: Dusun Manis, RT 02 / RW 01" required>{{ old('alamat', auth()->user()->profile->alamat ?? '') }}</textarea>
              @error('alamat')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Keperluan Pembuatan Surat <span class="text-danger">*</span></label>
              <textarea name="keperluan" rows="3" class="form-control" 
                        placeholder="Jelaskan alasan/keperluan surat (misal: pengajuan beasiswa, pinjaman bank, dll)" required>{{ old('keperluan') }}</textarea>
              @error('keperluan')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Upload Berkas Pendukung (KTP/KK)</label>
              <input type="file" name="file_persyaratan" class="form-control">
              <small class="text-muted">Format: PDF, JPG, PNG (Maksimal 5MB). Opsional jika berkas fisik dibawa langsung.</small>
              @error('file_persyaratan')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn-hw-primary w-100 py-3 justify-content-center">
              <i class="bi bi-send"></i> Kirim Permohonan Surat
            </button>
          </form>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4" data-aos="fade-left">
        <!-- Daftar Layanan -->
        <div class="sidebar-widget">
          <h5 class="widget-title"><i class="bi bi-list-check me-2"></i>Layanan Tersedia</h5>
          @foreach($layananList as $index => $lay)
            <div class="mb-3 p-3 {{ $loop->iteration % 2 == 1 ? 'layanan-item-odd' : 'layanan-item-even' }}" style="border-radius: var(--radius-sm); transition: all 0.3s ease;">
              <h6 class="fw-bold mb-2" style="color: var(--clr-heading);">{{ $lay->nama_layanan }}</h6>
              <p class="small text-muted mb-2" style="line-height: 1.6;">{{ $lay->deskripsi }}</p>
              <div class="small mb-2" style="color: #64748b;">
                <strong><i class="bi bi-clipboard-check me-1"></i>Syarat:</strong> {{ $lay->persyaratan ?? 'KTP & KK' }}
              </div>
              @if($lay->format_file)
                <a href="{{ asset('storage/' . $lay->format_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="bi bi-download"></i> Unduh Blangko
                </a>
              @endif
            </div>
          @endforeach
        </div>

        <!-- Alur -->
        <div class="sidebar-widget" style="background: var(--clr-primary-light);">
          <h5 class="widget-title" style="color: var(--clr-primary);"><i class="bi bi-check-circle me-2"></i>Alur Pembuatan</h5>
          <ol class="ps-3 mb-0 small" style="line-height: 1.8;">
            <li class="mb-2">Isi formulir online secara lengkap dan valid</li>
            <li class="mb-2">Petugas desa memeriksa kelengkapan data warga</li>
            <li class="mb-2">Surat diproses dan ditandatangani pejabat desa</li>
            <li>Warga mengambil surat jadi di Balai Desa dengan KTP asli</li>
          </ol>
        </div>
      </div>
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
