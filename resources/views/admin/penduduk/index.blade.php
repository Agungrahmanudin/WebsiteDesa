@extends('admin.layout.app')

@section('title', 'Data Penduduk - Admin Desa Cimeong')
@section('header-title', 'Data Kependudukan Desa')

@section('content')
<!-- Ringkasan Statistik Penduduk -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <div class="card border-l-4 border-l-custom-500">
        <div class="card-body p-4">
            <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Total Penduduk Terdata</span>
            <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ number_format($totalPenduduk) }} Jiwa</h3>
        </div>
    </div>
    <div class="card border-l-4 border-l-sky-500">
        <div class="card-body p-4">
            <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Penduduk Laki-Laki</span>
            <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ number_format($totalLaki) }} Jiwa</h3>
        </div>
    </div>
    <div class="card border-l-4 border-l-pink-500">
        <div class="card-body p-4">
            <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Penduduk Perempuan</span>
            <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ number_format($totalPerempuan) }} Jiwa</h3>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Daftar Penduduk Desa Cimeong</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Kelola master data kependudukan untuk administrasi surat dan sensus</p>
            </div>
            <div>
                <a href="{{ route('admin.penduduk.create') }}" class="flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition">
                    <i data-lucide="user-plus" class="size-4"></i> Tambah Penduduk
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('admin.penduduk.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-6 p-4 rounded-lg bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600">
            <div class="md:col-span-6">
                <input type="text" name="cari" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Cari NIK, Nama, atau Pekerjaan..." value="{{ request('cari') }}">
            </div>
            <div class="md:col-span-2">
                <select name="jenis_kelamin" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">
                    <option value="">Semua Gender</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <input type="text" name="rt" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Filter RT..." value="{{ request('rt') }}">
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full flex items-center justify-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg bg-slate-700 text-white hover:bg-slate-800 transition">
                    <i data-lucide="search" class="size-3.5"></i> Saring
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 text-xs text-left">
                        <th class="px-3.5 py-2.5 font-semibold">NIK</th>
                        <th class="px-3.5 py-2.5 font-semibold">Nama Lengkap</th>
                        <th class="px-3.5 py-2.5 font-semibold">L/P</th>
                        <th class="px-3.5 py-2.5 font-semibold">Tempat, Tgl Lahir</th>
                        <th class="px-3.5 py-2.5 font-semibold">Alamat (RT/RW)</th>
                        <th class="px-3.5 py-2.5 font-semibold">Pekerjaan</th>
                        <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduk as $p)
                        <tr class="border-b border-slate-100 hover:bg-slate-100 dark:border-zink-600 dark:hover:bg-zink-700/50 transition odd:bg-white even:bg-slate-50/50 dark:odd:bg-zink-700 dark:even:bg-zink-600/50">
                            <td class="px-3.5 py-3 font-mono text-xs text-slate-600 dark:text-zink-200">{{ $p->nik }}</td>
                            <td class="px-3.5 py-3">
                                <div class="font-medium text-slate-800 dark:text-zink-50 text-sm">{{ $p->nama }}</div>
                                <span class="text-xs text-slate-400">{{ $p->status_keluarga ?? 'Warga' }}</span>
                            </td>
                            <td class="px-3.5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $p->jenis_kelamin == 'L' ? 'bg-sky-50 text-sky-600 border border-sky-200' : 'bg-pink-50 text-pink-600 border border-pink-200' }}">
                                    {{ $p->jenis_kelamin }}
                                </span>
                            </td>
                            <td class="px-3.5 py-3 text-xs text-slate-600 dark:text-zink-200">
                                {{ $p->tempat_lahir }}, {{ $p->tanggal_lahir ? $p->tanggal_lahir->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-3.5 py-3 text-xs text-slate-600 dark:text-zink-200">
                                {{ $p->alamat }} (RT {{ $p->rt }} / RW {{ $p->rw }})
                            </td>
                            <td class="px-3.5 py-3 text-xs text-slate-600 dark:text-zink-200">
                                {{ $p->pekerjaan ?? '-' }}
                            </td>
                            <td class="px-3.5 py-3 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.penduduk.show', $p->id) }}" class="btn-action-view" title="Lihat Detail">
                                        <i data-lucide="eye" class="size-4"></i>
                                    </a>
                                    <a href="{{ route('admin.penduduk.edit', $p->id) }}" class="btn-action-edit" title="Edit">
                                        <i data-lucide="edit" class="size-4"></i>
                                    </a>
                                    <form action="{{ route('admin.penduduk.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data warga ini?')">
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
                            <td colspan="7" class="text-center py-8 text-slate-400 text-xs">Belum ada data penduduk yang cocok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $penduduk->links() }}
        </div>
    </div>
</div>
@endsection



