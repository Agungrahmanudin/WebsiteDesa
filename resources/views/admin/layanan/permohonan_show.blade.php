@extends('admin.layout.app')

@section('title', 'Detail Permohonan Surat - Admin Desa Cimeong')
@section('header-title', 'Detail Permohonan Surat')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Permohonan Surat</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap permohonan surat dari warga</p>
                    </div>
                    <a href="{{ route('admin.permohonan.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                    </a>
                </div>

                <!-- Content 2 Column -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Info -->
                    <div class="lg:col-span-7">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Pemohon</h6>
                                
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="user" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Nama Lengkap</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $permohonan->nama_pemohon }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="credit-card" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">NIK</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $permohonan->nik }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="map-pin" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Alamat Lengkap</p>
                                            <p class="text-sm text-slate-700 dark:text-zink-50">{{ $permohonan->alamat }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="file-text" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Jenis Layanan Surat</p>
                                            <p class="text-sm font-semibold text-custom-600">{{ $permohonan->layanan->nama_layanan ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="message-square" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Keperluan / Tujuan Surat</p>
                                            <p class="text-sm text-slate-700 dark:text-zink-50">{{ $permohonan->keperluan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Berkas Persyaratan -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-15 font-semibold">Berkas Persyaratan</h6>
                                @if($permohonan->file_persyaratan)
                                    <div class="p-4 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <i data-lucide="file-check" class="size-8 text-green-600"></i>
                                            </div>
                                            <div class="flex-grow">
                                                <p class="text-sm font-semibold text-green-700 dark:text-green-400 mb-1">File Persyaratan Tersedia</p>
                                                <p class="text-xs text-green-600 dark:text-green-300">Pemohon telah mengunggah berkas pendukung</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <a href="{{ asset('storage/' . $permohonan->file_persyaratan) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded-md transition">
                                                    <i data-lucide="eye" class="size-4"></i> Lihat Berkas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 bg-slate-50 dark:bg-zink-600 border border-slate-200 dark:border-zink-500 rounded-lg text-center">
                                        <i data-lucide="file-x" class="size-8 text-slate-400 mx-auto mb-2"></i>
                                        <p class="text-sm text-slate-500 dark:text-zink-300">Tidak ada berkas yang diunggah</p>
                                        <p class="text-xs text-slate-400 dark:text-zink-400">Pemohon akan membawa berkas fisik langsung</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Status -->
                    <div class="lg:col-span-5">
                        <!-- Status Card -->
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Status & Tracking</h6>
                                
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-2">Status Saat Ini:</p>
                                        @if($permohonan->status == 'menunggu')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                                <i data-lucide="clock" class="size-4 mr-1.5"></i> Menunggu Verifikasi
                                            </span>
                                        @elseif($permohonan->status == 'diproses')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold bg-custom-50 text-custom-700 border border-custom-200">
                                                <i data-lucide="loader" class="size-4 mr-1.5"></i> Sedang Diproses
                                            </span>
                                        @elseif($permohonan->status == 'selesai')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold bg-green-50 text-green-700 border border-green-200">
                                                <i data-lucide="check-circle" class="size-4 mr-1.5"></i> Selesai / Siap Diambil
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold bg-red-50 text-red-700 border border-red-200">
                                                <i data-lucide="x-circle" class="size-4 mr-1.5"></i> Ditolak
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Tanggal Pengajuan:</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $permohonan->created_at->format('d F Y, H:i') }} WIB</p>
                                    </div>

                                    @if($permohonan->catatan)
                                        <div class="p-3 bg-slate-50 dark:bg-zink-600 rounded-lg border border-slate-200 dark:border-zink-500">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Catatan Petugas:</p>
                                            <p class="text-sm text-slate-700 dark:text-zink-50">{{ $permohonan->catatan }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Update Status Form -->
                                <form action="{{ route('admin.permohonan.update', $permohonan->id) }}" method="POST" class="mt-5 pt-4 border-t border-slate-200 dark:border-zink-500">
                                    @csrf
                                    @method('PUT')
                                    
                                    <h6 class="mb-3 text-sm font-semibold">Update Status Permohonan</h6>
                                    
                                    <div class="mb-3">
                                        <label class="inline-block mb-1.5 text-xs font-medium">Ubah Status</label>
                                        <select name="status" class="form-select w-full text-xs border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 rounded-md" required>
                                            <option value="menunggu" {{ $permohonan->status == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                            <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                            <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai / Siap Diambil</option>
                                            <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="inline-block mb-1.5 text-xs font-medium">Catatan untuk Warga</label>
                                        <textarea name="catatan" rows="3" class="form-input w-full text-xs border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 rounded-md" placeholder="Berikan informasi tambahan kepada pemohon...">{{ $permohonan->catatan }}</textarea>
                                    </div>

                                    <button type="submit" class="w-full px-4 py-2.5 text-xs font-semibold text-white bg-custom-500 hover:bg-custom-600 rounded-md transition flex items-center justify-center gap-2">
                                        <i data-lucide="save" class="size-4"></i> Simpan Perubahan Status
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-sm font-semibold">Aksi Lainnya</h6>
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.permohonan.index') }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="arrow-left" class="size-4"></i> Kembali ke Daftar
                                    </a>
                                    <form action="{{ route('admin.permohonan.destroy', $permohonan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus permohonan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Permohonan
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
