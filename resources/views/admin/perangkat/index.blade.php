@extends('admin.layout.app')

@section('title', 'Perangkat Desa - Admin Desa Cimeong')
@section('header-title', 'Struktur & Perangkat Desa')

@section('content')
<div class="flex flex-col gap-5">
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Aparatur / Perangkat Desa</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola data aparatur/perangkat pemerintah desa</p>
        </div>
        <a href="{{ route('admin.perangkat.create') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
            <i data-lucide="plus" class="size-4"></i> Tambah Perangkat
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold w-16">Urutan</th>
                    <th class="px-3.5 py-2.5 font-semibold">Foto</th>
                    <th class="px-3.5 py-2.5 font-semibold">Nama Lengkap</th>
                    <th class="px-3.5 py-2.5 font-semibold">Jabatan</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($perangkat as $p)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-zink-600/50 transition">
                        <td class="px-3.5 py-3 text-xs font-semibold text-slate-500">
                            #{{ $p->urutan }}
                        </td>
                        <td class="px-3.5 py-3">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}" class="size-9 rounded-full object-cover border border-slate-200 shadow-sm">
                            @else
                                <div class="size-9 rounded-full bg-custom-500 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                    {{ strtoupper(substr($p->nama, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="font-semibold text-slate-800 dark:text-zink-50 text-xs">{{ $p->nama }}</span>
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-blue-50 text-blue-600 border border-blue-200">
                                {{ $p->jabatan }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.perangkat.show', $p->id) }}" class="btn-action-view" title="Lihat Detail">
                                    <i data-lucide="eye" class="size-4"></i>
                                </a>
                                <a href="{{ route('admin.perangkat.edit', $p->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                <form action="{{ route('admin.perangkat.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perangkat desa ini?')">
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
                        <td colspan="5" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">Belum ada perangkat desa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $perangkat->links() }}
    </div>
</div>
</div>
@endsection