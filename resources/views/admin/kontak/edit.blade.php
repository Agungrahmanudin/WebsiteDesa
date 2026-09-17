@extends('admin.layout.app')

@section('title', 'Profil & Kontak Desa - Admin Desa Cimeong')
@section('header-title', 'Pengaturan Profil & Kontak Desa')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="mb-5 pb-4 border-b border-slate-100 dark:border-zink-600">
        <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Informasi Resmi Kantor Pemerintah Desa</h5>
        <p class="text-xs text-slate-500 dark:text-zink-300">Data ini ditampilkan pada header, footer, dan halaman kontak website</p>
    </div>

    <form action="{{ route('admin.kontak.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Instansi <span class="text-red-500">*</span></label>
                <input type="text" name="nama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama', $kontak->nama) }}" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Desa (untuk tampilan website)</label>
                <input type="text" name="nama_desa" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama_desa', $kontak->nama_desa) }}" placeholder="Contoh: Desa Cimeong">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Email Resmi Desa</label>
                <input type="email" name="email" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('email', $kontak->email) }}">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">No. Telepon / WhatsApp</label>
                <input type="text" name="no_telepon" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('no_telepon', $kontak->no_telepon) }}">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="2" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>{{ old('alamat', $kontak->alamat) }}</textarea>
            </div>

            {{-- Hero Image Upload --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Foto Hero Beranda <span class="text-slate-400 font-normal">(foto utama halaman depan website)</span></label>
                @if($kontak->hero_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $kontak->hero_image) }}" alt="Hero" class="w-32 h-20 object-cover rounded-lg border border-slate-200">
                        <p class="text-[10px] text-slate-400 mt-1">Foto hero saat ini</p>
                    </div>
                @endif
                <input type="file" name="hero_image" accept="image/*" class="custom-file-input">
                <p class="text-[10px] text-slate-400 mt-1.5">Rekomendasi ukuran: 900×1000px atau lebih besar. Format: JPG, PNG, WebP. Max 5MB.</p>
            </div>

            {{-- Logo Upload --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Logo Desa <span class="text-slate-400 font-normal">(navbar, footer & loading)</span></label>
                @if($kontak->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $kontak->logo) }}" alt="Logo" class="w-16 h-16 object-contain rounded-lg border border-slate-200 p-1 bg-white">
                        <p class="text-[10px] text-slate-400 mt-1">Logo saat ini</p>
                    </div>
                @endif
                <input type="file" name="logo" accept="image/*" class="custom-file-input">
            </div>

            <div class="md:col-span-2 mt-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-zink-600 pb-2 mb-3">
                    <i data-lucide="target" class="size-4 text-custom-500"></i>
                    <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100">Visi, Misi & Sejarah Desa (Ditampilkan di Halaman Profil)</h6>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Visi Desa</label>
                <textarea name="visi" rows="3" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Masukkan visi desa...">{{ old('visi', $kontak->visi) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Misi Desa <span class="text-slate-400 font-normal">(tulis tiap poin misi di baris baru)</span></label>
                <textarea name="misi" rows="5" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Tuliskan tiap poin misi per baris...">{{ old('misi', $kontak->misi) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Sejarah Singkat Desa</label>
                <textarea name="sejarah" rows="4" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Tuliskan sejarah singkat desa...">{{ old('sejarah', $kontak->sejarah) }}</textarea>
            </div>

            <div class="md:col-span-2 mt-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-zink-600 pb-2 mb-3">
                    <i data-lucide="clock" class="size-4 text-custom-500"></i>
                    <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100">Jadwal Pelayanan (Ditampilkan di Halaman Depan)</h6>
                </div>
            </div>

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Senin - Kamis</label>
                    <input type="text" name="jadwal_senin_kamis" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('jadwal_senin_kamis', $kontak->jadwal_senin_kamis ?? '08.00 - 15.00') }}" placeholder="08.00 - 15.00">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Jumat</label>
                    <input type="text" name="jadwal_jumat" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('jadwal_jumat', $kontak->jadwal_jumat ?? '08.00 - 11.30') }}" placeholder="08.00 - 11.30">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Sabtu & Minggu</label>
                    <input type="text" name="jadwal_weekend" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('jadwal_weekend', $kontak->jadwal_weekend ?? 'Libur') }}" placeholder="Libur">
                </div>
            </div>

            <div class="md:col-span-2 mt-4">
                <div class="flex items-center gap-2 border-b border-slate-100 dark:border-zink-600 pb-2 mb-3">
                    <i data-lucide="share-2" class="size-4 text-custom-500"></i>
                    <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100">Tautan Media Sosial Resmi</h6>
                </div>
            </div>

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Facebook Page URL</label>
                    <input type="text" name="facebook" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('facebook', $kontak->facebook) }}" placeholder="https://facebook.com/...">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Instagram Profile URL</label>
                    <input type="text" name="instagram" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('instagram', $kontak->instagram) }}" placeholder="https://instagram.com/...">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Channel YouTube URL</label>
                    <input type="text" name="youtube" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('youtube', $kontak->youtube) }}" placeholder="https://youtube.com/...">
                </div>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-zink-600 flex justify-end">
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
                <i data-lucide="check" class="size-4"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
