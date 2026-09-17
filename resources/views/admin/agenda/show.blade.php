@extends('admin.layout.app')

@section('title', 'Detail Agenda - Admin Desa Cimeong')
@section('header-title', 'Detail Agenda')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Agenda Kegiatan</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap agenda</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.agenda.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                            <i data-lucide="arrow-left" class="size-4"></i> Kembali
                        </a>
                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                            <i data-lucide="edit" class="size-4"></i> Edit
                        </a>
                    </div>
                </div>

                <!-- Content 2 Column -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Info -->
                    <div class="lg:col-span-7">
                        @if($agenda->gambar)
                            <div class="mb-4 rounded-lg overflow-hidden">
                                <img src="{{ Str::startsWith($agenda->gambar, 'http') ? $agenda->gambar : asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="w-full" style="max-height: 350px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <div class="flex items-center gap-2 mb-4">
                                    @if($agenda->status == 'akan')
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200">Akan Datang</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 border border-green-200">Terlaksana</span>
                                    @endif
                                </div>
                                
                                <h3 class="text-xl font-bold mb-4">{{ $agenda->judul }}</h3>
                                
                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center gap-2 text-sm">
                                        <i data-lucide="calendar" class="size-4 text-custom-500"></i>
                                        <span class="font-semibold">Tanggal:</span>
                                        <span>{{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('d F Y, H:i') : '-' }}</span>
                                    </div>
                                    @if($agenda->tanggal_selesai)
                                        <div class="flex items-center gap-2 text-sm">
                                            <i data-lucide="calendar-check" class="size-4 text-green-500"></i>
                                            <span class="font-semibold">Selesai:</span>
                                            <span>{{ $agenda->tanggal_selesai->format('d F Y, H:i') }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-2 text-sm">
                                        <i data-lucide="map-pin" class="size-4 text-red-500"></i>
                                        <span class="font-semibold">Lokasi:</span>
                                        <span>{{ $agenda->lokasi }}</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-slate-200 dark:border-zink-500">
                                    <h6 class="text-sm font-semibold mb-2">Deskripsi Kegiatan:</h6>
                                    <div class="text-sm" style="white-space: pre-line;">{{ $agenda->deskripsi ?? 'Tidak ada deskripsi' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="lg:col-span-5">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Agenda</h6>
                                
                                <div class="space-y-3">
                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Dibuat pada</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $agenda->created_at->format('d F Y, H:i') }}</p>
                                    </div>

                                    <div class="p-3 rounded-lg bg-slate-50 dark:bg-zink-600">
                                        <p class="text-xs text-slate-500 dark:text-zink-200 mb-1">Terakhir Diupdate</p>
                                        <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $agenda->updated_at->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-sm font-semibold">Aksi</h6>
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                        <i data-lucide="edit" class="size-4"></i> Edit Agenda
                                    </a>
                                    <a href="{{ route('admin.agenda.index') }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin hapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Agenda
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
