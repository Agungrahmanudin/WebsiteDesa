@extends('admin.layout.app')

@section('title', 'Edit Perangkat Desa - Admin Desa Cimeong')
@section('header-title', 'Edit Perangkat Desa')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-6 shadow-sm w-full">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 dark:border-zink-600">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Edit Data Aparatur Desa</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Perbarui data nama, jabatan, urutan atau foto perangkat desa</p>
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

    <form action="{{ route('admin.perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input type="text" name="nama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama', $perangkat->nama) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('jabatan', $perangkat->jabatan) }}" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Urutan Tampil <span class="text-red-500">*</span></label>
                <input type="number" name="urutan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('urutan', $perangkat->urutan) }}" min="1" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-zink-200 mb-1.5">Foto Aparatur <span class="text-slate-400 font-normal">(opsional)</span></label>
                @if($perangkat->foto)
                    <div class="mb-3 flex items-center gap-3 p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                        <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}" class="size-14 rounded-full object-cover border-2 border-white shadow-sm">
                        <p class="text-xs text-slate-600 dark:text-zink-200">Foto saat ini</p>
                    </div>
                @endif
                <div class="border-2 border-dashed border-slate-200 dark:border-zink-500 rounded-lg p-6 text-center hover:border-custom-400 transition">
                    <div class="flex flex-col items-center">
                        <div class="size-12 rounded-full bg-slate-100 dark:bg-zink-600 flex items-center justify-center mb-3">
                            <i data-lucide="upload" class="size-6 text-slate-400"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-700 dark:text-zink-100 mb-1">Pilih gambar atau drag & drop di sini</p>
                        <p class="text-xs text-slate-400 mb-3">JPG, PNG, WEBP (Maks 3MB) - Kosongkan jika tidak ingin mengganti</p>
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
                <i data-lucide="check" class="size-4"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection