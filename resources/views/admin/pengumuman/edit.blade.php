@extends('admin.layout.app')

@section('title', 'Edit Pengumuman - Admin Desa Cimeong')
@section('header-title', 'Edit Pengumuman')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-4 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Edit Pengumuman Desa</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Perbarui rincian pengumuman</p>
        </div>
        <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 dark:border-zink-500 text-slate-600 dark:text-zink-200 hover:bg-slate-50 dark:hover:bg-zink-600 self-start sm:self-auto">
            <i data-lucide="arrow-left" class="size-4"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            <div class="lg:col-span-8 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Judul Pengumuman <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('judul', $pengumuman->judul) }}" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Isi Pengumuman <span class="text-red-500">*</span></label>
                    <textarea name="isi" rows="8" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-slate-50 dark:bg-zink-600/50 rounded-xl p-4 border border-slate-100 dark:border-zink-500 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai ? $pengumuman->tanggal_mulai->format('Y-m-d') : '') }}" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai ? $pengumuman->tanggal_selesai->format('Y-m-d') : '') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                            <option value="aktif" {{ old('status', $pengumuman->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $pengumuman->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Ganti Gambar</label>
                        @if($pengumuman->gambar)
                            <div class="mb-2 rounded-lg overflow-hidden max-h-32 border border-slate-200 dark:border-zink-500">
                                <img src="{{ Str::startsWith($pengumuman->gambar, 'http') ? $pengumuman->gambar : asset('storage/' . $pengumuman->gambar) }}" class="w-full h-28 object-cover" alt="Preview">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="gambar" id="gambar_edit" class="hidden" accept="image/*" onchange="updateFileName(this, 'gambar-edit-label')">
                            <label for="gambar_edit" class="flex items-center justify-center w-full px-4 py-3 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-white dark:bg-zink-700 hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                <div class="text-center">
                                    <i data-lucide="upload-cloud" class="inline-block size-4 text-slate-400 dark:text-zink-300 mb-1"></i>
                                    <p class="text-slate-600 dark:text-zink-200 font-medium text-[11px]" id="gambar-edit-label">Pilih foto atau drag & drop di sini</p>
                                    <span class="text-[10px] text-slate-400 block mt-0.5">JPG, PNG, WEBP (Maks 20MB)</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm mt-2">
                        <i data-lucide="check" class="size-4"></i> Perbarui
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function updateFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Pilih foto atau drag & drop di sini';
    }
}
</script>
@endsection
