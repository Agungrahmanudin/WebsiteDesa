@extends('admin.layout.app')

@section('title', 'Tambah Perangkat Desa - Admin Desa Cimeong')
@section('header-title', 'Tambah Perangkat Desa')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-6 shadow-sm w-full">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Tambah Aparatur Desa Baru</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Tambahkan data aparatur pemerintah desa beserta foto dan jabatannya</p>
        </div>
        <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
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

    <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input type="text" name="nama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama') }}" placeholder="Contoh: H. Suherman, S.Pd" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('jabatan') }}" placeholder="Contoh: Kepala Desa / Sekretaris Desa" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="urutan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('urutan', $nextUrutan ?? 1) }}" min="1" required>
                <p class="text-[11px] text-slate-400 mt-1">Nomor urut terkecil tampil paling atas pada bagan struktur organisasi.</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Foto Formal <span class="text-slate-400 font-normal">(opsional)</span></label>
                <div class="border-2 border-dashed border-slate-200 dark:border-zink-500 rounded-lg p-6 text-center hover:border-custom-400 transition">
                    <div class="flex flex-col items-center">
                        <div class="size-12 rounded-full bg-slate-100 dark:bg-zink-600 flex items-center justify-center mb-3">
                            <i data-lucide="upload" class="size-6 text-slate-400"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-700 dark:text-zink-100 mb-1">Pilih gambar atau drag & drop di sini</p>
                        <p class="text-xs text-slate-400 mb-3">JPG, PNG, WEBP (Maks 3MB)</p>
                        <label class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-custom-500 hover:bg-custom-600 text-white text-xs font-semibold cursor-pointer transition">
                            <i data-lucide="image" class="size-3.5"></i>
                            <span>Pilih File</span>
                            <input type="file" name="foto" accept="image/*" class="hidden">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-5 mt-6 border-t border-slate-100 dark:border-zink-600">
            <a href="{{ route('admin.perangkat.index') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm">
                <i data-lucide="check" class="size-4"></i> Simpan Perangkat
            </button>
        </div>
    </form>
</div>
@endsection