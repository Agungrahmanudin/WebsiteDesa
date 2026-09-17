@extends('admin.layout.app')

@section('title', 'Detail Berita - Admin Desa Cimeong')
@section('header-title', 'Detail Berita')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Berita</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap berita</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                            <i data-lucide="arrow-left" class="size-4"></i> Kembali
                        </a>
                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                            <i data-lucide="edit" class="size-4"></i> Edit
                        </a>
                    </div>
                </div>

                <!-- Content 2 Column -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                    <!-- Main Info -->
                    <div class="lg:col-span-8">
                        @if($berita->gambar)
                            <div class="mb-4 rounded-lg overflow-hidden">
                                <img src="{{ Str::startsWith($berita->gambar, 'http') ? $berita->gambar : asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full" style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <div class="flex items-center gap-2 mb-4">
                                    @if($berita->status == 'publish')
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-600 border border-green-200">Published</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-50 text-yellow-600 border border-yellow-200">Draft</span>
                                    @endif
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-custom-50 text-custom-600">{{ $berita->kategori->nama_kategori ?? '-' }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold mb-4">{{ $berita->judul }}</h3>
                                
                                <div class="prose max-w-none text-sm" style="white-space: pre-line;">{{ $berita->isi }}</div>

                                @if($berita->tags->count() > 0)
                                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-zink-500">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="text-xs text-slate-500"><i data-lucide="tags" class="size-3.5 inline"></i> Tags:</span>
                                            @foreach($berita->tags as $t)
                                                <span class="px-2 py-0.5 text-xs rounded bg-slate-100 text-slate-700 dark:bg-zink-600 dark:text-zink-200">#{{ $t->nama_tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="lg:col-span-4">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Publikasi</h6>
                                
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="calendar" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Tanggal Dibuat</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $berita->created_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="refresh-cw" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Terakhir Diupdate</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $berita->updated_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 py-2">
                                        <div class="flex-shrink-0 text-slate-500">
                                            <i data-lucide="link" class="size-4"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-xs text-slate-500 dark:text-zink-200 mb-0.5">Slug</p>
                                            <p class="text-sm font-mono text-slate-700 dark:text-zink-50 break-all">{{ $berita->slug }}</p>
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
                                    <a href="{{ route('berita.detail', $berita->slug) }}" target="_blank" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-white bg-custom-500 hover:bg-custom-600 rounded-md transition">
                                        <i data-lucide="external-link" class="size-4"></i> Lihat di Website
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-md transition">
                                        <i data-lucide="edit" class="size-4"></i> Edit Berita
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-md transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus Berita
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
