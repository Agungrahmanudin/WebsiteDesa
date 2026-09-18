@extends('admin.layout.app')

@section('title', 'Tambah Jenis Layanan - Admin Desa Cimeong')
@section('header-title', 'Tambah Jenis Layanan Surat')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-6 shadow-sm w-full">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Tambah Master Surat Baru</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Tambahkan jenis surat permohonan yang dapat diajukan warga desa secara online</p>
        </div>
        <a href="{{ route('admin.layanan.index') }}" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
            <i data-lucide="arrow-left" class="size-3.5"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="p-4 mb-5 text-xs text-red-600 rounded-lg bg-red-50 dark:bg-red-500/10 border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Layanan Surat <span class="text-red-500">*</span></label>
                <input type="text" name="nama_layanan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama_layanan') }}" placeholder="Misal: Surat Keterangan Usaha (SKU)" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Deskripsi Layanan</label>
                <textarea name="deskripsi" rows="3" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Penjelasan mengenai kegunaan surat ini...">{{ old('deskripsi') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Persyaratan Berkas</label>
                <textarea name="persyaratan" rows="3" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Contoh: Fotokopi KTP, KK, Surat Pengantar RT/RW...">{{ old('persyaratan') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">File Contoh Blangko / Format Dokumen <span class="text-slate-400 font-normal">(opsional)</span></label>
                <div class="relative">
                    <input type="file" name="format_file" id="format_file" class="hidden" accept=".pdf,.doc,.docx" onchange="updateFileName(this, 'format-label')">
                    <label for="format_file" class="flex items-center justify-center w-full px-4 py-3 text-xs border-2 border-dashed rounded-lg cursor-pointer border-slate-300 dark:border-zink-500 hover:border-custom-500 dark:hover:border-custom-500 bg-white dark:bg-zink-700 hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                        <div class="text-center">
                            <i data-lucide="upload-cloud" class="inline-block size-4 text-slate-400 dark:text-zink-300 mb-1"></i>
                            <p class="text-slate-600 dark:text-zink-200 font-medium text-[11px]" id="format-label">Pilih file atau drag & drop di sini</p>
                            <span class="text-[10px] text-slate-400 block mt-0.5">PDF, DOC, DOCX (Maks 5MB)</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-5 mt-6 border-t border-slate-100 dark:border-zink-600">
            <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm">
                <i data-lucide="check" class="size-4"></i> Simpan Layanan
            </button>
        </div>
    </form>
</div>

<script>
function updateFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Pilih file atau drag & drop di sini';
    }
}
</script>
@endsection