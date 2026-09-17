@extends('admin.layout.app')

@section('title', 'Jenis Layanan Surat - Admin Desa Cimeong')
@section('header-title', 'Master Jenis Layanan Surat')

@section('content')
<div class="flex flex-col gap-5">
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Jenis Layanan Surat</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola master template surat keterangan yang dapat diajukan warga</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
            <i data-lucide="plus" class="size-4"></i> Tambah Layanan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold">Nama Surat</th>
                    <th class="px-3.5 py-2.5 font-semibold">Persyaratan</th>
                    <th class="px-3.5 py-2.5 font-semibold">Total Pengajuan</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($layanan as $l)
                    <tr class="hover:bg-slate-100 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                        <td class="px-3.5 py-3">
                            <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs">{{ $l->nama_layanan }}</div>
                            <span class="text-xs text-slate-400 block line-clamp-1">{{ Str::limit($l->deskripsi, 60) }}</span>
                        </td>
                        <td class="px-3.5 py-3 text-xs text-slate-600 dark:text-zink-200">
                            {{ Str::limit($l->persyaratan, 50) }}
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-custom-50 text-custom-600 dark:bg-custom-500/10">
                                {{ $l->permohonan_count }} Surat
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.layanan.edit', $l->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $l->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus jenis layanan surat ini?')">
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
                        <td colspan="4" class="text-center py-8 text-slate-400 text-xs">Belum ada layanan surat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $layanan->links() }}
    </div>
</div>
</div>
@endsection