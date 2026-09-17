@extends('admin.layout.app')

@section('title', 'Detail Perangkat Desa - Admin Desa Cimeong')
@section('header-title', 'Detail Perangkat Desa')

@section('content')
<div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
    <div class="xl:col-span-12">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200 dark:border-zink-500">
                    <div>
                        <h5 class="text-16 font-semibold">Detail Perangkat Desa</h5>
                        <p class="text-slate-500 dark:text-zink-200 text-xs">Informasi lengkap aparatur/perangkat desa</p>
                    </div>
                    <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-custom-500 bg-custom-50 hover:bg-custom-100 rounded-md transition">
                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Foto -->
                    <div class="lg:col-span-4 flex flex-col items-center">
                        <div class="w-40 h-40 rounded-2xl overflow-hidden border-4 border-slate-100 shadow-md mb-4">
                            @if($perangkat->foto)
                                <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-custom-400 to-custom-600 flex items-center justify-center text-white text-5xl font-bold">
                                    {{ strtoupper(substr($perangkat->nama, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-zink-50 text-center">{{ $perangkat->nama }}</h4>
                        <span class="mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-custom-50 text-custom-600 border border-custom-200">
                            {{ $perangkat->jabatan }}
                        </span>
                    </div>

                    <!-- Detail Info -->
                    <div class="lg:col-span-8">
                        <div class="card border border-slate-200 dark:border-zink-500">
                            <div class="card-body">
                                <h6 class="mb-4 text-15 font-semibold">Informasi Perangkat</h6>
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3 py-3 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 dark:bg-zink-600 flex items-center justify-center text-slate-500">
                                            <i data-lucide="user" class="size-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-0.5">Nama Lengkap</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $perangkat->nama }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 py-3 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 dark:bg-zink-600 flex items-center justify-center text-slate-500">
                                            <i data-lucide="briefcase" class="size-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-0.5">Jabatan</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">{{ $perangkat->jabatan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 py-3 border-b border-slate-100 dark:border-zink-600">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 dark:bg-zink-600 flex items-center justify-center text-slate-500">
                                            <i data-lucide="list-ordered" class="size-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-0.5">Urutan Tampil</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">#{{ $perangkat->urutan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 py-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 dark:bg-zink-600 flex items-center justify-center text-slate-500">
                                            <i data-lucide="calendar" class="size-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-0.5">Ditambahkan</p>
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zink-50">
                                                {{ $perangkat->created_at ? $perangkat->created_at->format('d M Y, H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-6 pt-4 border-t border-slate-100 dark:border-zink-600">
                                    <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                                        <i data-lucide="arrow-left" class="size-4"></i> Kembali
                                    </a>
                                    <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}" method="POST" onsubmit="return confirm('Hapus perangkat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                                            <i data-lucide="trash-2" class="size-4"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection