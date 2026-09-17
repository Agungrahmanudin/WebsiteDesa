@extends('auth.layout.app')

@section('title', 'Daftar Akun Warga | Sistem Informasi Desa Cimeong')

@section('content')
<div class="mb-0 w-full card shadow-lg border-none shadow-slate-100 relative bg-white dark:bg-zink-700 rounded-xl">
    <div class="!px-8 !py-10 card-body">
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-3">
                <div class="flex items-center justify-center size-12 rounded-xl bg-custom-500/10 text-custom-500">
                    <i data-lucide="user-plus" class="size-6 text-custom-500"></i>
                </div>
            </a>
            <h4 class="text-xl font-bold text-slate-800 dark:text-zink-50">Daftar Akun Baru</h4>
            <p class="text-slate-500 dark:text-zink-200 mt-1 text-xs">Sistem Informasi & Layanan Mandiri Desa Cimeong</p>
        </div>

        @if($errors->any())
            <div class="mt-4 px-4 py-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-md">
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="inline-block mb-1.5 text-xs font-semibold text-slate-700 dark:text-zink-200">Nama Lengkap Sesuai KTP <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-3.5 py-2.5 text-xs border rounded-lg border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="Contoh: Budi Gunawan">
            </div>

            <div>
                <label for="email" class="inline-block mb-1.5 text-xs font-semibold text-slate-700 dark:text-zink-200">Alamat Email Aktif <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-3.5 py-2.5 text-xs border rounded-lg border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="inline-block mb-1.5 text-xs font-semibold text-slate-700 dark:text-zink-200">Kata Sandi (Minimal 6 Karakter) <span class="text-red-500">*</span></label>
                <input type="password" name="password" id="password" required class="w-full px-3.5 py-2.5 text-xs border rounded-lg border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="Buat kata sandi akun">
            </div>

            <div>
                <label for="password_confirmation" class="inline-block mb-1.5 text-xs font-semibold text-slate-700 dark:text-zink-200">Ulangi Kata Sandi <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-3.5 py-2.5 text-xs border rounded-lg border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="Konfirmasi kata sandi">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full text-white py-2.5 px-4 font-semibold text-xs rounded-lg bg-custom-500 hover:bg-custom-600 transition shadow-sm">
                    Daftar Sekarang
                </button>
            </div>

            <div class="pt-2 text-center text-xs text-slate-600 dark:text-zink-200">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-custom-500 hover:underline">Masuk Disini</a>
            </div>
        </form>
    </div>
</div>
@endsection

