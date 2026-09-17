@extends('admin.layout.app')

@section('title', 'Edit Jenis Layanan - Admin Desa Cimeong')
@section('header-title', 'Edit Jenis Layanan Surat')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-6 shadow-sm w-full">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Edit Jenis Layanan Surat</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Perbarui master informasi dan persyaratan surat keterangan</p>
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

    <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Layanan Surat <span class="text-red-500">*</span></label>
                <input type="text" name="nama_layanan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Deskripsi Layanan</label>
                <textarea name="deskripsi" rows="3" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Persyaratan Berkas</label>
                <textarea name="persyaratan" rows="3" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Ganti File Blangko Dokumen <span class="text-slate-400 font-normal">(opsional)</span></label>
                @if($layanan->format_file)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $layanan->format_file) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-custom-600 hover:underline">
                            <i data-lucide="file-text" class="size-3.5"></i> Lihat file blangko saat ini
                        </a>
                    </div>
                @endif
                <div class="file-upload-box">
                    <label class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-md bg-custom-500 hover:bg-custom-600 text-white text-xs font-semibold cursor-pointer transition shrink-0 shadow-sm">
                        <i data-lucide="upload" class="size-3.5"></i>
                        <span>Pilih File</span>
                        <input type="file" name="format_file" accept=".pdf,.doc,.docx" class="hidden" onchange="handleFileChange(this)">
                    </label>
                    <span class="file-name-text text-xs text-slate-400 ml-3 truncate">Belum ada file dipilih</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah file blangko.</p>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-5 mt-6 border-t border-slate-100 dark:border-zink-600">
            <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm">
                <i data-lucide="check" class="size-4"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection