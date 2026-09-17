<!-- AstroWind Announcement Top Bar -->
<div class="text-xs bg-slate-900 text-slate-300 dark:bg-slate-950 dark:border-b dark:border-slate-800 dark:text-slate-400 hidden md:flex items-center justify-between gap-1 overflow-hidden px-4 py-2 relative text-ellipsis whitespace-nowrap z-50">
    <div class="flex items-center gap-2">
        <span class="bg-blue-600 text-white font-bold px-1.5 py-0.5 text-[10px] rounded tracking-wider uppercase">RESMI</span>
        <span class="text-slate-300 font-medium">Portal Resmi Informasi & Layanan Digital Pemerintah Desa Cimeong</span>
    </div>
    <div class="flex items-center gap-4 text-slate-400 text-[11px]">
        <span><i data-lucide="clock" class="size-3 inline mr-1"></i> Jam Layanan: 08.00 - 15.00 WIB</span>
        <span><i data-lucide="map-pin" class="size-3 inline mr-1"></i> Kec. Banjaran, Majalengka</span>
    </div>
</div>

<!-- AstroWind Header / Navbar -->
<header class="sticky top-0 z-40 flex-none mx-auto w-full border-b border-gray-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md transition-all" id="header">
    <div class="relative text-default py-3 px-4 md:px-6 mx-auto w-full max-w-7xl flex items-center justify-between">
        
        <!-- Logo Desa Cimeong (AstroWind Logo Style) -->
        <div class="flex items-center">
            <a class="flex items-center gap-2.5 font-bold text-xl md:text-2xl text-slate-900 dark:text-white" href="{{ route('home') }}">
                <div class="flex items-center justify-center size-9 rounded-lg bg-blue-600 text-white shadow-sm">
                    <i data-lucide="landmark" class="size-5"></i>
                </div>
                <span class="tracking-tight">Desa <span class="text-blue-600">Cimeong</span></span>
            </a>
        </div>

        <!-- Navigation Links (AstroWind Menu items) -->
        <nav class="items-center hidden md:flex md:mx-5 text-default" aria-label="Main navigation">
            <ul class="flex flex-col md:flex-row md:self-center w-full md:w-auto text-sm tracking-[0.01rem] font-medium md:justify-center gap-1 lg:gap-2">
                <li>
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('home') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('profil') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('profil') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Profil Desa
                    </a>
                </li>
                <li>
                    <a href="{{ route('berita') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('berita*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Berita
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengumuman') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('pengumuman*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Pengumuman
                    </a>
                </li>
                <li>
                    <a href="{{ route('agenda') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('agenda*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Agenda
                    </a>
                </li>
                <li>
                    <a href="{{ route('galeri') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('galeri*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Galeri
                    </a>
                </li>
                <li>
                    <a href="{{ route('layanan') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('layanan*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Layanan Surat
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="px-3 py-2 rounded-md transition duration-150 ease-in-out {{ request()->routeIs('kontak*') ? 'text-blue-600 font-semibold bg-blue-50/80 dark:bg-blue-950/50' : 'text-slate-700 dark:text-slate-200 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        Kontak
                    </a>
                </li>
            </ul>
        </nav>

        <!-- AstroWind Action Buttons -->
        <div class="flex items-center gap-2.5">
            <a href="{{ route('layanan') }}" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold rounded-full border border-blue-600 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-950/50 transition duration-150">
                <i data-lucide="file-text" class="size-3.5"></i> Buat Surat
            </a>
            
            @auth
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-sm transition duration-150">
                    <i data-lucide="layout-dashboard" class="size-3.5"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-sm transition duration-150">
                    <i data-lucide="log-in" class="size-3.5"></i> Masuk
                </a>
            @endauth

            <!-- Mobile Toggle -->
            <button type="button" id="astrowind-menu-btn" class="flex items-center justify-center p-2 rounded-lg text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 md:hidden" aria-label="Toggle Menu">
                <i data-lucide="menu" class="size-5"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div id="astrowind-mobile-menu" class="hidden md:hidden px-4 pb-4 pt-2 border-t border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xl">
        <ul class="flex flex-col gap-1 text-sm font-medium text-slate-700 dark:text-slate-200">
            <li><a href="{{ route('home') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">Beranda</a></li>
            <li><a href="{{ route('profil') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('profil') ? 'text-blue-600 font-semibold' : '' }}">Profil Desa</a></li>
            <li><a href="{{ route('berita') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('berita*') ? 'text-blue-600 font-semibold' : '' }}">Berita</a></li>
            <li><a href="{{ route('pengumuman') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('pengumuman*') ? 'text-blue-600 font-semibold' : '' }}">Pengumuman</a></li>
            <li><a href="{{ route('agenda') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('agenda*') ? 'text-blue-600 font-semibold' : '' }}">Agenda</a></li>
            <li><a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('galeri*') ? 'text-blue-600 font-semibold' : '' }}">Galeri</a></li>
            <li><a href="{{ route('layanan') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('layanan*') ? 'text-blue-600 font-semibold' : '' }}">Layanan Surat</a></li>
            <li><a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-md hover:bg-slate-50 dark:hover:bg-slate-800 {{ request()->routeIs('kontak*') ? 'text-blue-600 font-semibold' : '' }}">Kontak</a></li>
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('astrowind-menu-btn');
        const mobileMenu = document.getElementById('astrowind-mobile-menu');
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
