@extends('admin.layout.app')

@section('title', 'Edit Berita - Admin Desa Cimeong')
@section('header-title', 'Edit Berita Desa')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Edit Artikel Berita</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Perbarui data atau isi konten berita desa</p>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
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

        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Judul Berita <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('judul', $berita->judul) }}" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Isi Konten Berita <span class="text-red-500">*</span></label>
                        <textarea name="isi" rows="14" class="w-full text-sm px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600 space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Kategori Berita <span class="text-red-500">*</span></label>
                            <select name="kategori_id" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $berita->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Status Publikasi <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                                <option value="publish" {{ old('status', $berita->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Gambar Utama</label>
                            @if($berita->gambar)
                                <div class="mb-2 rounded-lg overflow-hidden h-28 bg-slate-100">
                                    <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover" alt="Preview">
                                </div>
                            @endif
                            <div class="relative">
                                <input type="file" name="gambar" id="gambar-edit" class="hidden" accept="image/*" onchange="updateFileName(this, 'gambar-edit-label')">
                                <label for="gambar-edit" class="flex items-center justify-center w-full px-4 py-3 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-slate-50 dark:bg-zink-700 hover:bg-slate-100 dark:hover:bg-zink-600 transition-all">
                                    <div class="text-center">
                                        <i data-lucide="upload-cloud" class="inline-block size-5 text-slate-400 dark:text-zink-300 mb-1"></i>
                                        <p class="text-slate-600 dark:text-zink-200 font-medium" id="gambar-edit-label">Pilih gambar baru (opsional)</p>
                                        <span class="text-[11px] text-slate-400 block mt-1">Kosongkan jika tidak ingin mengganti gambar</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Tag / Label</label>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $selectedTags = $berita->tags->pluck('id')->toArray();
                                @endphp
                                @foreach($tagList as $t)
                                    <label class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md bg-white dark:bg-zink-600 border border-slate-200 dark:border-zink-500 cursor-pointer hover:bg-slate-100">
                                        <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ in_array($t->id, $selectedTags) ? 'checked' : '' }} class="rounded text-custom-500">
                                        <span class="text-slate-700 dark:text-zink-100">{{ $t->nama_tag }}</span>
                                    </label>
                                @endforeach
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
        label.textContent = 'Pilih gambar baru (opsional)';
    }
}
</script>
@endsection

