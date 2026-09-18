@php $kontakDesa = \App\Models\Kontak::first(); @endphp
@extends('auth.layout.app')

@section('title', 'Masuk | Sistem Informasi ' . ($kontakDesa->nama_desa ?? 'Desa'))

@section('content')
<div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
    <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <div class="!px-12 !py-12 card-body">
                
                <div class="text-center">
                    <h4 class="mb-2 text-purple-500 dark:text-purple-500">Selamat Datang Kembali!</h4>
                    <p class="text-slate-500 dark:text-zink-200">Masuk ke Panel Administrasi {{ $kontakDesa->nama_desa ?? 'Desa' }}</p>
                </div>
        
                <form action="{{ route('login.post') }}" method="POST" class="mt-10" id="signInForm">
                    @csrf
                    
                    @if(session('success'))
                        <div class="px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="px-4 py-3 mb-3 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="px-4 py-3 mb-3 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="email" class="inline-block mb-2 text-base font-medium">Email / Username</label>
                        <input type="text" name="email" id="email" value="{{ old('email', old('username')) }}" required class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Masukkan email atau username">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Kata Sandi</label>
                        <input type="password" name="password" id="password" required class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Masukkan kata sandi">
                    </div>
                    
                    <div>
                        <div class="flex items-center gap-2">
                            <input id="remember" name="remember" class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400" type="checkbox" value="">
                            <label for="remember" class="inline-block text-base font-medium align-middle cursor-pointer">Ingat saya</label>
                        </div>
                    </div>
                    
                    <div class="mt-10">
                        <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Masuk</button>
                    </div>
        
                    <div class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                        <h5 class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">Atau masuk dengan</h5>
                    </div>
        
                    <div class="flex flex-wrap justify-center gap-2">
                        <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"><i data-lucide="facebook" class="size-4"></i></button>
                        <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"><i data-lucide="mail" class="size-4"></i></button>
                        <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"><i data-lucide="twitter" class="size-4"></i></button>
                        <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 active:text-white active:bg-slate-600 active:border-slate-600"><i data-lucide="github" class="size-4"></i></button>
                    </div>
        
                    <div class="mt-10 text-center">
                        <p class="mb-0 text-slate-500 dark:text-zink-200">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Daftar Sekarang</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
            <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                <div class="flex items-center justify-between gap-3">
                    <div class="grow">
                        <a href="{{ route('home') }}">
                            @if($kontakDesa && $kontakDesa->logo)
                                <img src="{{ asset('storage/' . $kontakDesa->logo) }}" alt="{{ $kontakDesa->nama_desa ?? 'Logo' }}" class="h-10 object-contain">
                            @else
                                <img src="{{ asset('assets_admin/assets/images/logo-light.png') }}" alt="Logo" class="hidden h-6 dark:block">
                                <img src="{{ asset('assets_admin/assets/images/logo-dark.png') }}" alt="Logo" class="block h-6 dark:hidden">
                            @endif
                        </a>
                    </div>
                    <div class="shrink-0">
                        <div class="text-end">
                            <h6 class="text-base font-medium text-slate-600 dark:text-zink-200">{{ $kontakDesa->nama_desa ?? 'Desa' }}</h6>
                            <p class="text-xs text-slate-500 dark:text-zink-300">Sistem Informasi Desa</p>
                        </div>
                    </div>
                </div>
                <div class="mt-auto">
                    <img src="{{ asset('assets_admin/assets/images/img-01.png') }}" alt="" class="md:max-w-[32rem] mx-auto">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

