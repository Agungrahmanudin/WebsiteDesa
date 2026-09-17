@extends('admin.layout.app')

@section('title', 'Kelola Berita - Admin Desa Cimeong')
@section('header-title', 'Manajemen Berita & Artikel Desa')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Daftar Berita Desa</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Kelola seluruh publikasi artikel dan kabar terkini desa Cimeong</p>
            </div>
            <div>
                <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition">
                    <i data-lucide="plus-circle" class="size-4"></i> Tulis Berita Baru
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <form action="{{ route('admin.berita.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-6 p-4 rounded-lg bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600">
            <div class="md:col-span-5">
                <input type="text" name="cari" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Cari judul berita..." value="{{ request('cari') }}">
            </div>
            <div class="md:col-span-3">
                <select name="kategori" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $k)
                        <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <select name="status" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">
                    <option value="">Semua Status</option>
                    <option value="publish" {{ request('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full flex items-center justify-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg bg-slate-700 text-white hover:bg-slate-800 transition">
                    <i data-lucide="filter" class="size-3.5"></i> Saring
                </button>
            </div>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 text-xs text-left">
                        <th class="px-3.5 py-2.5 font-semibold w-20">Gambar</th>
                        <th class="px-3.5 py-2.5 font-semibold">Judul Berita</th>
                        <th class="px-3.5 py-2.5 font-semibold">Kategori</th>
                        <th class="px-3.5 py-2.5 font-semibold">Status</th>
                        <th class="px-3.5 py-2.5 font-semibold">Tanggal</th>
                        <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $b)
                        <tr class="border-b border-slate-100 hover:bg-slate-100 dark:border-zink-600 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                            <td class="px-3.5 py-3">
                                <div class="size-12 rounded-lg overflow-hidden shrink-0 bg-slate-100">
                                    @if($b->gambar)
                                        <img src="{{ Str::startsWith($b->gambar, 'http') ? $b->gambar : asset('storage/' . $b->gambar) }}" class="w-full h-full object-cover" alt="Thumb">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400 text-xs">
                                            <i data-lucide="image" class="size-4"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3.5 py-3">
                                <div class="font-medium text-slate-800 dark:text-zink-50 text-sm">{{ $b->judul }}</div>
                                <span class="text-xs text-slate-400">/berita/{{ $b->slug }}</span>
                            </td>
                            <td class="px-3.5 py-3">
                                <span class="px-2.5 py-1 text-xs rounded-full bg-slate-100 text-slate-600 dark:bg-zink-600 dark:text-zink-200">
                                    {{ $b->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-3.5 py-3">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $b->status == 'publish' ? 'bg-green-50 text-green-600 border border-green-200' : 'bg-slate-100 text-slate-500' }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td class="px-3.5 py-3 text-xs text-slate-500">
                                {{ $b->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-3.5 py-3 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.berita.show', $b->id) }}" class="btn-action-view" title="Lihat Detail">
                                        <i data-lucide="eye" class="size-4"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $b->id) }}" class="btn-action-edit" title="Edit">
                                        <i data-lucide="edit" class="size-4"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                            <td colspan="6" class="text-center py-8 text-slate-400 text-xs">Tidak ada data berita ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $berita->links() }}
        </div>
    </div>
</div>
@endsection



