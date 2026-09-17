@extends('admin.layout.app')

@section('title', 'Edit Media Galeri - Admin Desa Cimeong')
@section('header-title', 'Edit Media Galeri')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Edit Media Galeri</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Perbarui informasi atau file media galeri</p>
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

        <form action="{{ route('admin.galeri.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Judul Media <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('judul', $item->judul) }}" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Keterangan / Deskripsi</label>
                        <textarea name="keterangan" rows="6" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">{{ old('keterangan', $item->keterangan) }}</textarea>
                    </div>

                    <div class="p-4 rounded-lg bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600">
                        <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100 mb-3">File Media Saat Ini</h6>
                        
                        @if($item->kategori == 'foto')
                            <div class="mb-3 rounded-lg overflow-hidden h-48 bg-slate-900 flex items-center justify-center">
                                <img src="{{ Str::startsWith($item->file, 'http') ? $item->file : asset('storage/' . $item->file) }}" class="w-full h-full object-contain" alt="Preview">
                            </div>
                        @else
                            <div class="mb-3 p-4 rounded-lg bg-slate-800 text-center">
                                <i data-lucide="play-circle" class="size-12 text-white mx-auto mb-2"></i>
                                <p class="text-xs text-slate-300">Video: {{ Str::limit($item->file, 50) }}</p>
                                <a href="{{ $item->file }}" target="_blank" class="text-xs text-custom-400 hover:text-custom-300">Buka Video</a>
                            </div>
                        @endif

                        <hr class="my-4 border-slate-200 dark:border-zink-500">

                        <h6 class="text-xs font-semibold text-slate-700 dark:text-zink-100 mb-3">Upload File Baru (Opsional)</h6>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Upload Foto/Video Baru</label>
                            <div class="relative">
                                <input type="file" name="file_upload" id="file_upload_edit" class="hidden" accept="image/*,video/mp4" onchange="updateFileName(this, 'file-upload-edit-label')">
                                <label for="file_upload_edit" class="flex items-center justify-center w-full px-4 py-3 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-white dark:bg-zink-700 hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                    <div class="text-center">
                                        <i data-lucide="upload-cloud" class="inline-block size-5 text-slate-400 dark:text-zink-300 mb-1"></i>
                                        <p class="text-slate-600 dark:text-zink-200 font-medium" id="file-upload-edit-label">Pilih file baru (opsional)</p>
                                        <span class="text-[11px] text-slate-400 block mt-1">Kosongkan jika tidak ingin mengganti file</span>
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
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Link URL Media Baru (YouTube, dll)</label>
                            <input type="text" name="file_url" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('file_url') }}" placeholder="https://youtube.com/watch?v=...">
                            <span class="text-[11px] text-slate-400 block mt-1">Masukkan URL baru jika ingin mengganti media</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600 space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Kategori Media <span class="text-red-500">*</span></label>
                            <select name="kategori" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                                <option value="foto" {{ old('kategori', $item->kategori) == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ old('kategori', $item->kategori) == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                            <div class="flex gap-2">
                                <i data-lucide="info" class="size-4 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5"></i>
                                <div>
                                    <h6 class="text-xs font-semibold text-blue-700 dark:text-blue-300 mb-1">Catatan</h6>
                                    <p class="text-[11px] text-blue-600 dark:text-blue-400 leading-relaxed">
                                        Kosongkan upload file dan URL jika tidak ingin mengganti media yang sudah ada.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm mt-4">
                            <i data-lucide="save" class="size-4"></i> Simpan Perubahan
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
        label.textContent = 'Pilih file baru (opsional)';
    }
}
</script>
@endsection
