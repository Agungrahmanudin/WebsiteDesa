@extends('admin.layout.app')

@section('title', 'Detail Galeri - Admin Desa Cimeong')
@section('header-title', 'Detail Galeri')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Media Galeri</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap media galeri</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                            <i data-lucide="arrow-left" class="size-4"></i> Kembali
                        </a>
                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                            <i data-lucide="edit" class="size-4"></i> Edit
                        </a>
                    </div>
                </div>

                <!-- Content 2 Column -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Info -->
                    <div class="lg:col-span-8">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <!-- Media Preview -->
                                <div class="mb-4 rounded-lg overflow-hidden bg-slate-900">
                                    @if($item->kategori == 'foto')
                                        <img src="{{ Str::startsWith($item->file, 'http') ? $item->file : asset('storage/' . $item->file) }}" alt="{{ $item->judul }}" class="w-full" style="max-height: 500px; object-fit: contain;">
                                    @else
                                        <div class="aspect-video flex items-center justify-center bg-slate-800">
                                            <div class="text-center">
                                                <i data-lucide="play-circle" class="size-16 text-white mx-auto mb-3"></i>
                                                <a href="{{ $item->file }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                                    <i data-lucide="external-link" class="size-4"></i> Buka Video
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Title & Description -->
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $item->kategori == 'foto' ? 'bg-sky-50 text-sky-600 border border-sky-200' : 'bg-purple-50 text-purple-600 border border-purple-200' }}">
                                        {{ ucfirst($item->kategori) }}
                                    </span>
                                </div>
                                
                                <h3 class="text-xl font-bold mb-4">{{ $item->judul }}</h3>
                                
                                @if($item->keterangan)
                                    <div class="text-sm text-slate-600 dark:text-zink-300" style="white-space: pre-line;">{{ $item->keterangan }}</div>
                                @else
                                    <p class="text-sm text-slate-400 dark:text-zink-400 italic">Tidak ada keterangan</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="lg:col-span-4">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Media</h6>
                                
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="image" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Tipe Media</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ ucfirst($item->kategori) }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="calendar" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Tanggal Upload</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $item->created_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Terakhir Diupdate</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $item->updated_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card border border-slate-200 dark:border-zink-500 mt-4">
                            <div class="card-body">
                                <h6 class="mb-3 text-sm font-semibold">Aksi</h6>
                                <div class="flex flex-col gap-2">
                                    @if($item->kategori == 'foto')
                                        <a href="{{ Str::startsWith($item->file, 'http') ? $item->file : asset('storage/' . $item->file) }}" target="_blank" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                            <i data-lucide="external-link" class="size-4"></i> Buka Foto Full
                                        </a>
                                    @else
                                        <a href="{{ $item->file }}" target="_blank" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                            <i data-lucide="external-link" class="size-4"></i> Buka Video
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.galeri.edit', $item->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="edit" class="size-4"></i> Edit Media
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus media galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Media
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
