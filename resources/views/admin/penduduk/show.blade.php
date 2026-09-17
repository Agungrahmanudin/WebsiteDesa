@extends('admin.layout.app')

@section('title', 'Detail Data Penduduk - Admin Desa Cimeong')
@section('header-title', 'Detail Data Penduduk')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Data Penduduk</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap data kependudukan</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                            <i data-lucide="arrow-left" class="size-4"></i> Kembali
                        </a>
                        <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                            <i data-lucide="edit" class="size-4"></i> Edit
                        </a>
                    </div>
                </div>

                <!-- Content 2 Column -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Info -->
                    <div class="lg:col-span-7">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Data Pribadi</h6>
                                
                                <div class="space-y-3">
                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">NIK</div>
                                        <div class="flex-grow text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $penduduk->nik }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Nama Lengkap</div>
                                        <div class="flex-grow text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $penduduk->nama }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Jenis Kelamin</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">
                                            @if($penduduk->jenis_kelamin == 'L')
                                                <span class="px-2 py-0.5 text-xs rounded bg-blue-50 text-blue-600">Laki-Laki</span>
                                            @else
                                                <span class="px-2 py-0.5 text-xs rounded bg-pink-50 text-pink-600">Perempuan</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Tempat, Tgl Lahir</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d F Y') }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Agama</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">{{ $penduduk->agama }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Pekerjaan</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">{{ $penduduk->pekerjaan ?? '-' }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Status Keluarga</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">{{ $penduduk->status_keluarga ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Alamat & Wilayah</h6>
                                
                                <div class="space-y-3">
                                    <div class="flex gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">Alamat</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">{{ $penduduk->alamat }}</div>
                                    </div>

                                    <div class="flex gap-3 py-2">
                                        <div class="w-32 text-xs text-slate-500 dark:text-zink-200">RT / RW</div>
                                        <div class="flex-grow text-sm text-slate-700 dark:text-zink-50">
                                            <span class="px-2 py-0.5 text-xs rounded bg-custom-50 text-custom-600 font-semibold">RT {{ $penduduk->rt }}</span>
                                            <span class="mx-1">/</span>
                                            <span class="px-2 py-0.5 text-xs rounded bg-green-50 text-green-600 font-semibold">RW {{ $penduduk->rw }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-5">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Data</h6>
                                
                                <div class="space-y-3">
                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Data dibuat pada</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $penduduk->created_at->format('d F Y, H:i') }}</p>
                                    </div>

                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Terakhir Diupdate</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $penduduk->updated_at->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-sm font-semibold">Aksi</h6>
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.penduduk.edit', $penduduk->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                        <i data-lucide="edit" class="size-4"></i> Edit Data
                                    </a>
                                    <a href="{{ route('admin.penduduk.index') }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                                    </a>
                                    <form action="{{ route('admin.penduduk.destroy', $penduduk->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data penduduk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Data
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
