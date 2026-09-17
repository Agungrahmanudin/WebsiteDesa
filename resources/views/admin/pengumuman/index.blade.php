@extends('admin.layout.app')

@section('title', 'Kelola Pengumuman - Admin Desa Cimeong')
@section('header-title', 'Pengumuman Resmi Desa')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Pengumuman</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola edaran dan pengumuman untuk seluruh masyarakat desa</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm self-start sm:self-auto">
            <i data-lucide="plus" class="size-4"></i> Buat Pengumuman Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold">Judul Pengumuman</th>
                    <th class="px-3.5 py-2.5 font-semibold">Periode Tayang</th>
                    <th class="px-3.5 py-2.5 font-semibold">Status</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($pengumuman as $p)
                    <tr class="hover:bg-slate-100 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                        <td class="px-3.5 py-3">
                            <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs mb-0.5">{{ $p->judul }}</div>
                            <p class="text-[11px] text-slate-400 dark:text-zink-300">{{ Str::limit($p->isi, 90) }}</p>
                        </td>
                        <td class="px-3.5 py-3 text-xs text-slate-500 dark:text-zink-300">
                            {{ $p->tanggal_mulai ? $p->tanggal_mulai->format('d/m/Y') : '-' }} s/d {{ $p->tanggal_selesai ? $p->tanggal_selesai->format('d/m/Y') : 'Seterusnya' }}
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium {{ $p->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-800' : 'bg-slate-100 text-slate-600 border border-slate-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-500' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="inline-flex items-center gap-3">
                                <a href="{{ route('admin.pengumuman.show', $p->id) }}" class="btn-action-view" title="Lihat Detail">
                                    <i data-lucide="eye" class="size-4"></i>
                                </a>
                                <a href="{{ route('admin.pengumuman.edit', $p->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengumuman ini?')">
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
                        <td colspan="4" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">Belum ada data pengumuman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pengumuman->links() }}
    </div>
</div>
@endsection



