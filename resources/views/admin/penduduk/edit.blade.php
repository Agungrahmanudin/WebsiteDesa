@extends('admin.layout.app')

@section('title', 'Edit Data Penduduk - Admin Desa Cimeong')
@section('header-title', 'Edit Data Penduduk')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Edit Data Penduduk: {{ $penduduk->nama }}</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Perbarui data kependudukan warga desa</p>
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

        <form action="{{ route('admin.penduduk.update', $penduduk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">NIK (16 Digit) <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nik', $penduduk->nik) }}" required>
                </div>
                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('nama', $penduduk->nama) }}" required>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>
                        <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                        <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" class="w-full text-xs px-3 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('Y-m-d') : '') }}" required>
                </div>

                <div class="md:col-span-6">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" class="w-full text-xs px-3.5 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" required>{{ old('alamat', $penduduk->alamat) }}</textarea>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">RT <span class="text-red-500">*</span></label>
                    <input type="text" name="rt" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('rt', $penduduk->rt) }}" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">RW <span class="text-red-500">*</span></label>
                    <input type="text" name="rw" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('rw', $penduduk->rw) }}" required>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Status Keluarga</label>
                    <input type="text" name="status_keluarga" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('status_keluarga', $penduduk->status_keluarga) }}">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-xs font-medium text-slate-700 dark:text-zink-100 mb-1.5">Agama <span class="text-red-500">*</span></label>
                    <input type="text" name="agama" class="w-full text-xs px-3.5 py-2.5 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" value="{{ old('agama', $penduduk->agama) }}" required>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-200 dark:border-zink-500 flex justify-end">
                <button type="submit" class="flex items-center gap-1.5 px-5 py-2.5 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition shadow-sm">
                    <i data-lucide="save" class="size-4"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

