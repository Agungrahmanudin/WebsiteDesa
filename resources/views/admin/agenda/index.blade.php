@extends('admin.layout.app')

@section('title', 'Kelola Agenda - Admin Desa Cimeong')
@section('header-title', 'Agenda Kegiatan Desa')

@section('content')
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Agenda Kegiatan</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola jadwal kegiatan, rapat, dan acara di desa</p>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm self-start sm:self-auto">
            <i data-lucide="plus" class="size-4"></i> Buat Agenda Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold">Judul Agenda</th>
                    <th class="px-3.5 py-2.5 font-semibold">Tanggal Pelaksanaan</th>
                    <th class="px-3.5 py-2.5 font-semibold">Lokasi</th>
                    <th class="px-3.5 py-2.5 font-semibold">Status</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($agenda as $ag)
                    <tr class="hover:bg-slate-100 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                        <td class="px-3.5 py-3">
                            <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs mb-0.5">{{ $ag->judul }}</div>
                            <p class="text-[11px] text-slate-400 dark:text-zink-300">{{ Str::limit($ag->deskripsi, 80) }}</p>
                        </td>
                        <td class="px-3.5 py-3 text-xs text-slate-500 dark:text-zink-300">
                            <span class="inline-flex items-center gap-1">
                                <i data-lucide="calendar" class="size-3.5 text-slate-400"></i>
                                {{ $ag->tanggal_mulai ? $ag->tanggal_mulai->format('d/m/Y') : '-' }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-xs">
                            <span class="inline-flex items-center gap-1 text-slate-600 dark:text-zink-200">
                                <i data-lucide="map-pin" class="size-3.5 text-red-500"></i>
                                {{ $ag->lokasi }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium {{ $ag->status == 'akan' ? 'bg-amber-50 text-amber-600 border border-amber-200 dark:bg-amber-500/10 dark:text-amber-400' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400' }}">
                                {{ ucfirst($ag->status) }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="inline-flex items-center gap-3">
                                <a href="{{ route('admin.agenda.show', $ag->id) }}" class="btn-action-view" title="Lihat Detail">
                                    <i data-lucide="eye" class="size-4"></i>
                                </a>
                                <a href="{{ route('admin.agenda.edit', $ag->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                <form action="{{ route('admin.agenda.destroy', $ag->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus agenda ini?')">
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
                        <td colspan="5" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">Belum ada agenda kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $agenda->links() }}
    </div>
</div>
@endsection


