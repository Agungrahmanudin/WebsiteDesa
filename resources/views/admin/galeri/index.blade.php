@extends('admin.layout.app')

@section('title', 'Kelola Galeri - Admin Desa Cimeong')
@section('header-title', 'Galeri Foto & Video Desa')

@section('content')
<div class="flex flex-col gap-5">
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50">Daftar Dokumentasi Galeri</h5>
        <a href="{{ route('admin.galeri.create') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
            <i data-lucide="plus" class="size-4"></i> Tambah Media
        </a>
    </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                            <th class="px-3.5 py-2.5 font-semibold w-16">Media</th>
                            <th class="px-3.5 py-2.5 font-semibold">Judul & Keterangan</th>
                            <th class="px-3.5 py-2.5 font-semibold">Tipe</th>
                            <th class="px-3.5 py-2.5 font-semibold">Tanggal</th>
                            <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                        @forelse($galeri as $g)
                            <tr class="hover:bg-slate-100 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                                <td class="px-3.5 py-3">
                                    <div class="size-12 rounded-lg overflow-hidden shrink-0 bg-slate-900 flex items-center justify-center">
                                        @if($g->kategori == 'foto')
                                            <img src="{{ Str::startsWith($g->file, 'http') ? $g->file : asset('storage/' . $g->file) }}" class="w-full h-full object-cover" alt="Thumb">
                                        @else
                                            <i data-lucide="play-circle" class="size-6 text-white"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3.5 py-3">
                                    <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs mb-0.5">{{ $g->judul }}</div>
                                    <p class="text-[11px] text-slate-400 dark:text-zink-300">{{ Str::limit($g->keterangan, 70) ?: '-' }}</p>
                                </td>
                                <td class="px-3.5 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold uppercase {{ $g->kategori == 'foto' ? 'bg-sky-50 text-sky-600 border border-sky-200 dark:bg-sky-500/10 dark:text-sky-400' : 'bg-purple-50 text-purple-600 border border-purple-200 dark:bg-purple-500/10 dark:text-purple-400' }}">
                                        {{ $g->kategori }}
                                    </span>
                                </td>
                                <td class="px-3.5 py-3 text-xs text-slate-400 dark:text-zink-300">
                                    {{ $g->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-3.5 py-3 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.galeri.show', $g->id) }}" class="btn-action-view" title="Lihat Detail">
                                            <i data-lucide="eye" class="size-4"></i>
                                        </a>
                                        <a href="{{ route('admin.galeri.edit', $g->id) }}" class="btn-action-edit" title="Edit">
                                            <i data-lucide="edit" class="size-4"></i>
                                        </a>
                                        <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus item galeri ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete" title="Hapus">
                                                <i data-lucide="trash-2" class="size-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">
                                    Belum ada media galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $galeri->links() }}
            </div>
    </div>
</div>
@endsection




