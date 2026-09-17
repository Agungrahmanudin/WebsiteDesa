@extends('admin.layout.app')

@section('title', 'Tambah Data Penduduk - Admin Desa Cimeong')
@section('header-title', 'Tambah Penduduk Baru')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Formulir Data Penduduk</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Masukkan data identitas kependudukan warga desa</p>
            </div>
            <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
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

        <form action="{{ route('admin.penduduk.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">NIK (16 Digit) <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nik') }}" placeholder="32xxxxxxxxxxxxxx" required>
                </div>
                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama') }}" required>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tempat_lahir') }}" required>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_lahir') }}" required>
                </div>

                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Alamat Lengkap / Dusun <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">RT <span class="text-red-500">*</span></label>
                    <input type="text" name="rt" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('rt', '01') }}" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">RW <span class="text-red-500">*</span></label>
                    <input type="text" name="rw" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('rw', '01') }}" required>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Status Hubungan Keluarga</label>
                    <input type="text" name="status_keluarga" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('status_keluarga', 'Kepala Keluarga') }}" placeholder="Kepala Keluarga / Istri / Anak">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('pekerjaan') }}" placeholder="Petani / Pedagang / Wiraswasta">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Agama <span class="text-red-500">*</span></label>
                    <input type="text" name="agama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('agama', 'Islam') }}" required>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-200 dark:border-zink-500 flex justify-end">
                <button type="submit" class="flex items-center gap-1.5 px-5 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm">
                    <i data-lucide="save" class="size-4"></i> Simpan Data Penduduk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

