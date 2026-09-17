@extends('admin.layout.app')

@section('title', 'Manajemen User - Admin Desa Cimeong')
@section('header-title', 'Manajemen Pengguna')

@section('content')
<div class="flex flex-col gap-5">
<div class="card bg-white dark:bg-zink-700 border border-slate-200 dark:border-zink-500 rounded-xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50 mb-0.5">Daftar Pengguna Sistem</h5>
            <p class="text-xs text-slate-500 dark:text-zink-300">Kelola akun staf administrasi dan pengguna layanan desa</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-lg bg-custom-500 text-white hover:bg-custom-600 transition-colors shadow-sm">
            <i data-lucide="plus" class="size-4"></i> Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-300 text-xs text-left">
                    <th class="px-3.5 py-2.5 font-semibold">Nama Pengguna</th>
                    <th class="px-3.5 py-2.5 font-semibold">Email</th>
                    <th class="px-3.5 py-2.5 font-semibold">Role</th>
                    <th class="px-3.5 py-2.5 font-semibold">Status</th>
                    <th class="px-3.5 py-2.5 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-zink-600">
                @forelse($users as $u)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-zink-600/50 transition">
                        <td class="px-3.5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-slate-100 dark:bg-zink-600 text-slate-700 dark:text-zink-200 flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($u->name, 0, 2)) }}
                                </div>
                                <div class="font-semibold text-slate-800 dark:text-zink-50 text-xs">{{ $u->name }}</div>
                            </div>
                        </td>
                        <td class="px-3.5 py-3 text-xs text-slate-600 dark:text-zink-200">
                            {{ $u->email }}
                        </td>
                        <td class="px-3.5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-custom-50 text-custom-600 dark:bg-custom-500/10 dark:text-custom-400 border border-custom-200 dark:border-custom-800 uppercase">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="px-3.5 py-3">
                            @if($u->is_active)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-green-50 text-green-600 border border-green-200">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-red-50 text-red-600 border border-red-200">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-3.5 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-action-edit" title="Edit">
                                    <i data-lucide="edit" class="size-4"></i>
                                </a>
                                @if(auth()->id() !== $u->id)
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus">
                                            <i data-lucide="trash-2" class="size-4"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3.5 py-8 text-center text-slate-400 dark:text-zink-300 text-xs">Belum ada pengguna terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
</div>
@endsection