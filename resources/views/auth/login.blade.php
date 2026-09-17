@extends('auth.layout.app')

@section('title', 'Masuk | Sistem Informasi Desa Cimeong')

@section('content')
<div class="mb-0 w-full card shadow-lg border-none shadow-slate-100 relative bg-white dark:bg-zink-700 rounded-xl">
    <div class="!px-8 !py-10 card-body">
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-3">
                <div class="flex items-center justify-center size-12 rounded-xl bg-custom-500/10 text-custom-500">
                    <i data-lucide="landmark" class="size-6 text-custom-500"></i>
                </div>
            </a>
            <h4 class="text-xl font-bold text-slate-800 dark:text-zink-50">Desa Cimeong</h4>
            <p class="text-slate-500 dark:text-zink-200 mt-1 text-xs">Masuk ke Panel Administrasi Desa</p>
        </div>

        @if(session('success'))
            <div class="mt-4 px-4 py-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 px-4 py-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mt-4 px-4 py-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="mt-8">
            @csrf
            <div class="mb-4">
                <label for="email" class="inline-block mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">Email atau Username</label>
                <input type="text" name="email" id="email" value="{{ old('email', old('username')) }}" required class="form-input w-full px-3.5 py-2.5 text-sm border rounded-md border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="admin@desacimeong.id / admin">
            </div>
            <div class="mb-4">
                <label for="password" class="inline-block mb-2 text-sm font-medium text-slate-700 dark:text-zink-200">Kata Sandi</label>
                <input type="password" name="password" id="password" required class="form-input w-full px-3.5 py-2.5 text-sm border rounded-md border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 bg-white dark:bg-zink-600 dark:text-zink-100 placeholder:text-slate-400" placeholder="Masukkan password">
            </div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <input id="remember" name="remember" class="border rounded appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500" type="checkbox">
                    <label for="remember" class="inline-block text-sm text-slate-600 dark:text-zink-200 cursor-pointer">Ingat saya</label>
                </div>
                <a href="{{ route('home') }}" class="text-sm text-custom-500 hover:underline">Kembali ke Beranda</a>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full text-white py-2.5 px-4 font-medium rounded-md btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 transition duration-150">Masuk ke Sistem</button>
            </div>

            <div class="mt-4 text-center text-sm text-slate-600 dark:text-zink-200">
                Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-custom-500 hover:underline">Daftar Akun Baru</a>
            </div>

            <div class="mt-6 p-3 rounded-lg bg-slate-100 dark:bg-zink-600 text-xs text-slate-600 dark:text-zink-200 text-center">
                <strong>Login Admin:</strong> <code class="text-custom-500 font-bold">admin@desacimeong.id</code> atau <code class="text-custom-500 font-bold">admin@desa.id</code><br>
                <strong>Password:</strong> <code class="text-custom-500 font-bold">password</code>
            </div>
        </form>
    </div>
</div>
@endsection

