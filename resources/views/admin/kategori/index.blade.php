@extends('admin.layout.app')

@section('title', 'Kategori Berita - Admin Desa Cimeong')
@section('header-title', 'Kategori Berita')

@section('content')
<div class="flex flex-col gap-5">
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Kategori Berita</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola kategori untuk pengelompokan berita dan informasi desa</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
            <i data-lucide="plus" class="size-4"></i> Tambah Kategori
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold">Nama Kategori</th>
                    <th class="px-3.5 py-2.5 font-semibold">Slug</th>
                    <th class="px-3.5 py-2.5 font-semibold">Jumlah Berita</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($kategori as $k)
                    <tr class="hover:bg-slate-100 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                        <td class="px-3.5 py-3">
                            <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs">{{ $k->nama_kategori }}</div>
                            <small class="text-slate-400 dark:text-zink-300 text-[11px]">{{ $k->deskripsi ?: '-' }}</small>
                        </td>
                        <td class="px-3.5 py-3">
                            <code class="px-2 py-0.5 text-[11px] rounded bg-slate-100 dark:bg-zink-600 text-slate-600 dark:text-zink-200 font-mono">{{ $k->slug }}</code>
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-custom-50 text-custom-600 dark:bg-custom-500/10 dark:text-custom-400 border border-custom-200 dark:border-custom-800">
                                {{ $k->berita_count }} Berita
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.kategori.edit', $k->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
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
                        <td colspan="4" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $kategori->links() }}
    </div>
</div>
</div>
@endsection