@extends('admin.layout.app')

@section('title', 'Tambah Media Galeri - Admin Desa Cimeong')
@section('header-title', 'Tambah Media Galeri')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Formulir Media Galeri Baru</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Tambahkan foto atau video ke galeri dokumentasi desa</p>
            </div>
            <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
                <i data-lucide="arrow-left" class="size-3.5"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="p-4 mb-4 text-xs text-red-600 rounded-lg bg-red-50 dark:bg-red-500/10 border border-red-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Judul Media <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('judul') }}" placeholder="Contoh: Kegiatan Gotong Royong RT 01" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Keterangan / Deskripsi</label>
                        <textarea name="keterangan" rows="6" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Tuliskan deskripsi atau keterangan tentang media ini...">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="p-4 rounded-lg bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600">
                        <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100 mb-3">Upload File Media</h6>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Upload Foto/Video</label>
                            <div class="relative">
                                <input type="file" name="file_upload" id="file_upload" class="hidden" accept="image/*,video/mp4" onchange="updateFileName(this, 'file-upload-label')">
                                <label for="file_upload" class="flex items-center justify-center w-full px-4 py-3 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-white dark:bg-zink-700 hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                    <div class="text-center">
                                        <i data-lucide="upload-cloud" class="inline-block size-5 text-slate-400 dark:text-zink-300 mb-1"></i>
                                        <p class="text-slate-600 dark:text-zink-200 font-medium" id="file-upload-label">Pilih foto/video atau drag & drop di sini</p>
                                        <span class="text-[11px] text-slate-400 block mt-1">JPG, PNG, WEBP, MP4 (Maks 20MB)</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="relative my-3">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-200 dark:border-zink-500"></div>
                            </div>
                            <div class="relative flex justify-center text-[11px]">
                                <span class="px-2 bg-slate-50 dark:bg-zink-700/50 text-slate-500">ATAU</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Link URL Media (YouTube, dll)</label>
                            <input type="text" name="file_url" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('file_url') }}" placeholder="https://youtube.com/watch?v=...">
                            <span class="text-[11px] text-slate-400 block mt-1">Masukkan link YouTube atau URL media lainnya</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600 space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Kategori Media <span class="text-red-500">*</span></label>
                            <select name="kategori" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="foto" {{ old('kategori') == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ old('kategori') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                            <div class="flex gap-2">
                                <i data-lucide="info" class="size-4 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5"></i>
                                <div>
                                    <h6 class="text-xs font-semibold text-blue-700 dark:text-blue-300 mb-1">Catatan</h6>
                                    <p class="text-[11px] text-blue-600 dark:text-blue-400 leading-relaxed">
                                        Pilih salah satu: Upload file atau masukkan URL. Untuk video YouTube, disarankan menggunakan URL.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm mt-4">
                            <i data-lucide="upload" class="size-4"></i> Simpan Media
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Pilih foto/video atau drag & drop di sini';
    }
}
</script>
@endsection
