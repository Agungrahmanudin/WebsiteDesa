@extends('admin.layout.app')

@section('title', 'Dashboard Utama - Admin Desa Cimeong')
@section('header-title', 'Dashboard Ringkasan Sistem')

@section('content')
<!-- Welcome Banner -->
<div class="card bg-gradient-to-r from-custom-500 to-custom-700 text-white mb-6 border-0 shadow-md">
    <div class="card-body p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
                <p class="text-white/80 text-sm mb-0">Panel informasi dan administrasi pelayanan publik Sistem Informasi Desa Cimeong.</p>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('admin.permohonan.index') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-white text-custom-600 hover:bg-slate-100 transition">
                    Verifikasi Permohonan
                </a>
                <a href="{{ route('admin.berita.create') }}" class="px-4 py-2 text-xs font-semibold rounded-lg bg-custom-800 text-white hover:bg-custom-900 transition">
                    Tulis Berita Baru
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stat Counters -->
<div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4 mb-6">
    <!-- Stat 1 -->
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-12 bg-custom-50 text-custom-500 dark:bg-custom-500/10">
                    <i data-lucide="newspaper" class="size-6"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-0 text-slate-800 dark:text-zink-50">{{ $totalBerita }}</h4>
                    <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Total Berita Desa</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 2 -->
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-12 bg-green-50 text-green-500 dark:bg-green-500/10">
                    <i data-lucide="calendar-check-2" class="size-6"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-0 text-slate-800 dark:text-zink-50">{{ $totalAgenda }}</h4>
                    <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Agenda Kegiatan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 3 -->
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-12 bg-yellow-50 text-yellow-500 dark:bg-yellow-500/10">
                    <i data-lucide="megaphone" class="size-6"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-0 text-slate-800 dark:text-zink-50">{{ $totalPengumuman }}</h4>
                    <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Pengumuman Aktif</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 4 -->
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-12 bg-purple-50 text-purple-500 dark:bg-purple-500/10">
                    <i data-lucide="users" class="size-6"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-bold mb-0 text-slate-800 dark:text-zink-50">{{ number_format($totalPenduduk) }}</h4>
                    <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Data Penduduk</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Permohonan Status Cards -->
<div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-6">
    <div class="card border-l-4 border-l-yellow-500">
        <div class="card-body flex items-center justify-between p-4">
            <div>
                <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Surat Menunggu Verifikasi</span>
                <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ $permohonanMenunggu }}</h3>
            </div>
            <div class="size-10 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-500">
                <i data-lucide="clock" class="size-5"></i>
            </div>
        </div>
    </div>
    <div class="card border-l-4 border-l-custom-500">
        <div class="card-body flex items-center justify-between p-4">
            <div>
                <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Surat Sedang Diproses</span>
                <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ $permohonanDiproses }}</h3>
            </div>
            <div class="size-10 rounded-full bg-custom-50 flex items-center justify-center text-custom-500">
                <i data-lucide="loader-2" class="size-5 animate-spin"></i>
            </div>
        </div>
    </div>
    <div class="card border-l-4 border-l-green-500">
        <div class="card-body flex items-center justify-between p-4">
            <div>
                <span class="text-xs font-medium text-slate-500 dark:text-zink-300 block mb-1">Surat Selesai / Siap Ambil</span>
                <h3 class="text-xl font-bold text-slate-800 dark:text-zink-50 mb-0">{{ $permohonanSelesai }}</h3>
            </div>
            <div class="size-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                <i data-lucide="check-circle" class="size-5"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
    <!-- Permohonan Surat Masuk Table -->
    <div class="card lg:col-span-8">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold text-slate-800 dark:text-zink-50 flex items-center gap-2">
                    <i data-lucide="inbox" class="size-4 text-custom-500"></i> Permohonan Surat Terbaru
                </h6>
                <a href="{{ route('admin.permohonan.index') }}" class="text-xs font-medium text-custom-500 hover:text-custom-600 transition flex items-center gap-1">
                    Lihat Semua <i data-lucide="arrow-right" class="size-3"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 text-xs text-left">
                            <th class="px-3.5 py-2.5 font-semibold">Pemohon</th>
                            <th class="px-3.5 py-2.5 font-semibold">Layanan</th>
                            <th class="px-3.5 py-2.5 font-semibold">Tanggal</th>
                            <th class="px-3.5 py-2.5 font-semibold">Status</th>
                            <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonanTerbaru as $p)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 dark:border-zink-600 dark:hover:bg-zink-700/50 transition">
                                <td class="px-3.5 py-3">
                                    <div class="font-medium text-slate-800 dark:text-zink-50">{{ $p->nama_pemohon }}</div>
                                    <span class="text-xs text-slate-400">NIK: {{ $p->nik }}</span>
                                </td>
                                <td class="px-3.5 py-3 text-slate-600 dark:text-zink-200">{{ $p->layanan->nama_layanan ?? '-' }}</td>
                                <td class="px-3.5 py-3 text-slate-500 text-xs">{{ $p->created_at->format('d/m/Y') }}</td>
                                <td class="px-3.5 py-3">
                                    @if($p->status == 'menunggu')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-50 text-yellow-600 border border-yellow-200">Menunggu</span>
                                    @elseif($p->status == 'diproses')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-custom-50 text-custom-600 border border-custom-200">Diproses</span>
                                    @elseif($p->status == 'selesai')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-600 border border-green-200">Selesai</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-600 border border-red-200">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-3.5 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.permohonan.show', $p->id) }}" class="btn-action-view" title="Review Detail">
                                            <i data-lucide="eye" class="size-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-slate-400 text-xs">Belum ada permohonan surat masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Berita Terakhir List -->
    <div class="card lg:col-span-4">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h6 class="text-15 font-semibold text-slate-800 dark:text-zink-50 flex items-center gap-2">
                    <i data-lucide="newspaper" class="size-4 text-custom-500"></i> Berita Terakhir
                </h6>
                <a href="{{ route('admin.berita.index') }}" class="text-xs font-medium text-custom-500 hover:text-custom-600 transition flex items-center gap-1">
                    Kelola <i data-lucide="arrow-right" class="size-3"></i>
                </a>
            </div>

            <div class="flex flex-col gap-3">
                @forelse($beritaTerbaru as $b)
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 dark:hover:bg-zink-700 transition">
                        <div class="size-12 rounded-lg overflow-hidden shrink-0 bg-slate-100">
                            @if($b->gambar)
                                <img src="{{ Str::startsWith($b->gambar, 'http') ? $b->gambar : asset('storage/' . $b->gambar) }}" class="w-full h-full object-cover" alt="Thumb">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400 text-xs">
                                    <i data-lucide="image" class="size-4"></i>
                                </div>
                            @endif
                        </div>
                        <div class="grow min-w-0">
                            <a href="{{ route('admin.berita.edit', $b->id) }}" class="text-xs font-semibold text-slate-700 dark:text-zink-100 hover:text-custom-500 transition line-clamp-1 block">
                                {{ $b->judul }}
                            </a>
                            <div class="flex items-center gap-2 mt-1 text-[11px] text-slate-400">
                                <span>{{ $b->created_at->format('d M Y') }}</span>
                                <span>•</span>
                                <span class="capitalize {{ $b->status == 'publish' ? 'text-green-600 font-medium' : 'text-slate-400' }}">{{ $b->status }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 text-center py-4 mb-0">Belum ada postingan berita.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

