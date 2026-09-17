@extends('admin.layout.app')

@section('title', 'Detail Pengumuman - Admin Desa Cimeong')
@section('header-title', 'Detail Pengumuman')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Pengumuman</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap pengumuman</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                            <i data-lucide="arrow-left" class="size-4"></i> Kembali
                        </a>
                        <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                            <i data-lucide="edit" class="size-4"></i> Edit
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                        @if($pengumuman->gambar)
                            <div class="mb-4 rounded-lg overflow-hidden">
                                <img src="{{ Str::startsWith($pengumuman->gambar, 'http') ? $pengumuman->gambar : asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full" style="max-height: 350px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <div class="flex items-center gap-2 mb-4">
                                    @if($pengumuman->status == 'aktif')
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 border border-green-200">Aktif</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-600 border border-slate-200">Nonaktif</span>
                                    @endif
                                </div>
                                
                                <h3 class="text-xl font-bold mb-4">{{ $pengumuman->judul }}</h3>
                                
                                <div class="mb-4">
                                    <div class="flex items-center gap-3 text-sm text-slate-500">
                                        <span><i data-lucide="calendar" class="size-4 inline"></i> Berlaku: {{ $pengumuman->tanggal_mulai ? $pengumuman->tanggal_mulai->format('d M Y') : '-' }}</span>
                                        <span>s/d</span>
                                        <span>{{ $pengumuman->tanggal_selesai ? $pengumuman->tanggal_selesai->format('d M Y') : 'Seterusnya' }}</span>
                                    </div>
                                </div>

                                <div class="prose max-w-none text-sm" style="white-space: pre-line;">{{ $pengumuman->isi }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-4">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Pengumuman</h6>
                                
                                <div class="space-y-3">
                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Dibuat pada</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $pengumuman->created_at->format('d F Y, H:i') }}</p>
                                    </div>

                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Terakhir Diupdate</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $pengumuman->updated_at->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-sm font-semibold">Aksi</h6>
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                        <i data-lucide="edit" class="size-4"></i> Edit Pengumuman
                                    </a>
                                    <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                                    </a>
                                    <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Pengumuman
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
