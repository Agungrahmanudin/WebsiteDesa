@extends('admin.layout.app')

@section('title', 'Permohonan Surat - Admin Desa Cimeong')
@section('header-title', 'Daftar Permohonan Surat Warga')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h5 class="text-16 font-semibold text-slate-800 dark:text-zink-50 mb-1">Permohonan Surat Online Masuk</h5>
                <p class="text-xs text-slate-500 dark:text-zink-300 mb-0">Verifikasi berkas persyaratan dan perbarui status pengajuan surat warga</p>
            </div>
            <div>
                <a href="{{ route('admin.layanan.index') }}" class="flex items-center gap-1 px-3 py-2 text-xs font-medium rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 dark:border-zink-500 dark:text-zink-200 transition">
                    <i data-lucide="layers" class="size-4"></i> Kelola Jenis Layanan
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('admin.permohonan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-6 p-4 rounded-lg bg-slate-50 dark:bg-zink-700/50 border border-slate-200 dark:border-zink-600">
            <div class="md:col-span-5">
                <input type="text" name="cari" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500" placeholder="Cari nama pemohon atau NIK..." value="{{ request('cari') }}">
            </div>
            <div class="md:col-span-3">
                <select name="layanan_id" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">
                    <option value="">Semua Jenis Surat</option>
                    @foreach($layananList as $l)
                        <option value="{{ $l->id }}" {{ request('layanan_id') == $l->id ? 'selected' : '' }}>{{ $l->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <select name="status" class="w-full text-xs px-3 py-2 border rounded-lg border-slate-200 dark:border-zink-500 dark:bg-zink-700 focus:outline-none focus:border-custom-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full flex items-center justify-center gap-1 px-3 py-2 text-xs font-semibold rounded-lg bg-slate-700 text-white hover:bg-slate-800 transition">
                    <i data-lucide="filter" class="size-3.5"></i> Saring
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 text-xs text-left">
                        <th class="px-3.5 py-2.5 font-semibold">Pemohon</th>
                        <th class="px-3.5 py-2.5 font-semibold">Jenis Surat</th>
                        <th class="px-3.5 py-2.5 font-semibold">Keperluan & Alamat</th>
                        <th class="px-3.5 py-2.5 font-semibold">Berkas</th>
                        <th class="px-3.5 py-2.5 font-semibold">Status & Catatan</th>
                        <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonan as $p)
                        <tr class="border-b border-slate-100 hover:bg-slate-50/50 dark:border-zink-600 dark:hover:bg-zink-700/50 transition">
                            <td class="px-3.5 py-3">
                                <div class="font-medium text-slate-800 dark:text-zink-50 text-sm">{{ $p->nama_pemohon }}</div>
                                <span class="text-xs text-slate-400 block">NIK: {{ $p->nik }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $p->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="px-3.5 py-3">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-700 dark:bg-zink-600 dark:text-zink-200">
                                    {{ $p->layanan->nama_layanan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-3.5 py-3">
                                <div class="text-xs font-semibold text-slate-700 dark:text-zink-100">{{ $p->keperluan }}</div>
                                <span class="text-[11px] text-slate-400 block line-clamp-1">{{ Str::limit($p->alamat, 45) }}</span>
                            </td>
                            <td class="px-3.5 py-3">
                                @if($p->file_persyaratan)
                                    <a href="{{ asset('storage/' . $p->file_persyaratan) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded bg-green-50 text-green-600 hover:bg-green-100 transition">
                                        <i data-lucide="file-text" class="size-3.5"></i> Lihat Berkas
                                    </a>
                                @else
                                    <span class="text-slate-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-3.5 py-3">
                                @if($p->status == 'menunggu')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-50 text-yellow-600 border border-yellow-200 mb-1">Menunggu</span>
                                @elseif($p->status == 'diproses')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-custom-50 text-custom-600 border border-custom-200 mb-1">Diproses</span>
                                @elseif($p->status == 'selesai')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-600 border border-green-200 mb-1">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-600 border border-red-200 mb-1">Ditolak</span>
                                @endif
                                @if($p->catatan)
                                    <p class="text-[11px] text-slate-500 dark:text-zink-300 mb-0 line-clamp-1">{{ $p->catatan }}</p>
                                @endif
                            </td>
                            <td class="px-3.5 py-3 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.permohonan.show', $p->id) }}" class="btn-action-view" title="Lihat Detail">
                                        <i data-lucide="eye" class="size-4"></i>
                                    </a>
                                    <form action="{{ route('admin.permohonan.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus permohonan ini?')">
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
                            <td colspan="6" class="text-center py-8 text-slate-400 text-xs">Belum ada permohonan surat masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $permohonan->links() }}
        </div>
    </div>
</div>
@endsection

