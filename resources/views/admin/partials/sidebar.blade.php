<!-- App Menu / Sidebar -->
<div class="app-menu w-vertical-menu bg-vertical-menu ltr:border-r rtl:border-l border-vertical-menu-border fixed bottom-0 top-0 z-[1003] transition-all duration-75 ease-linear group-data-[sidebar-size=md]:w-vertical-menu-md group-data-[sidebar-size=sm]:w-vertical-menu-sm group-data-[sidebar-size=sm]:pt-header group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar=dark]:border-vertical-menu-dark group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar=brand]:border-vertical-menu-brand group-data-[sidebar=modern]:bg-gradient-to-tr group-data-[sidebar=modern]:to-vertical-menu-to-modern group-data-[sidebar=modern]:from-vertical-menu-form-modern group-data-[layout=horizontal]:w-full group-data-[layout=horizontal]:bottom-auto group-data-[layout=horizontal]:top-header hidden md:block print:hidden group-data-[sidebar-size=sm]:absolute group-data-[sidebar=modern]:border-vertical-menu-border-modern group-data-[layout=horizontal]:dark:bg-zink-700 group-data-[layout=horizontal]:border-t group-data-[layout=horizontal]:dark:border-zink-500 group-data-[layout=horizontal]:border-r-0 group-data-[sidebar=dark]:dark:bg-zink-700 group-data-[sidebar=dark]:dark:border-zink-600 group-data-[layout=horizontal]:group-data-[navbar=scroll]:absolute group-data-[layout=horizontal]:group-data-[navbar=bordered]:top-[calc(theme('spacing.header')_+_theme('spacing.4'))] group-data-[layout=horizontal]:group-data-[navbar=bordered]:inset-x-4 group-data-[layout=horizontal]:group-data-[navbar=hidden]:top-0 group-data-[layout=horizontal]:group-data-[navbar=hidden]:h-16 group-data-[layout=horizontal]:group-data-[navbar=bordered]:w-[calc(100%_-_2rem)] group-data-[layout=horizontal]:group-data-[navbar=bordered]:[&.sticky]:top-header group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-md group-data-[layout=horizontal]:shadow-md group-data-[layout=horizontal]:shadow-slate-500/10 group-data-[layout=horizontal]:dark:shadow-zink-500/10 group-data-[layout=horizontal]:opacity-0">
    
    <div class="flex items-center justify-center px-5 text-center h-header">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <div class="flex items-center justify-center size-9 rounded-lg bg-custom-500 text-white font-bold">
                <i data-lucide="landmark" class="size-5"></i>
            </div>
            <div class="text-start group-data-[sidebar-size=sm]:hidden">
                <span class="text-base font-bold tracking-tight text-slate-800 dark:text-zink-50 block leading-tight">DESA CIMEONG</span>
                <span class="text-[10px] text-slate-500 dark:text-zink-300 block uppercase font-medium">Panel Administrasi</span>
            </div>
        </a>
        <button type="button" class="hidden p-0 float-end" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" class="group-data-[sidebar-size=md]:max-h-[calc(100vh_-_theme('spacing.header')_*_1.2)] group-data-[sidebar-size=lg]:max-h-[calc(100vh_-_theme('spacing.header')_*_1.2)] overflow-y-auto">
        <div>
            <ul class="flex flex-col" id="navbar-nav">
                <!-- Section: Menu Utama -->
                <li class="px-4 py-1.5 text-vertical-menu-item uppercase font-medium text-[11px] cursor-default tracking-wider group-data-[sidebar-size=sm]:hidden">
                    <span>Menu Utama</span>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.dashboard') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.dashboard') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="layout-dashboard" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Dashboard</span>
                    </a>
                </li>

                <!-- Section: Publikasi & Konten -->
                <li class="px-4 py-1.5 mt-2 text-vertical-menu-item uppercase font-medium text-[11px] cursor-default tracking-wider group-data-[sidebar-size=sm]:hidden">
                    <span>Publikasi & Konten</span>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.berita*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.berita.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="newspaper" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Berita Desa</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.kategori*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.kategori.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="folder-kanban" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Kategori Berita</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.pengumuman*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.pengumuman.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="megaphone" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Pengumuman</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.agenda*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.agenda.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="calendar-days" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Agenda Kegiatan</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.galeri*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.galeri.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="image" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Galeri Foto</span>
                    </a>
                </li>

                <!-- Section: Pelayanan Warga -->
                <li class="px-4 py-1.5 mt-2 text-vertical-menu-item uppercase font-medium text-[11px] cursor-default tracking-wider group-data-[sidebar-size=sm]:hidden">
                    <span>Pelayanan Warga</span>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.permohonan*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.permohonan.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="file-check-2" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Permohonan Surat</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.layanan*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.layanan.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="mail-open" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Jenis Layanan</span>
                    </a>
                </li>

                <!-- Section: Data Desa & Pengaturan -->
                <li class="px-4 py-1.5 mt-2 text-vertical-menu-item uppercase font-medium text-[11px] cursor-default tracking-wider group-data-[sidebar-size=sm]:hidden">
                    <span>Data Desa & Master</span>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.penduduk*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.penduduk.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="users" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Data Penduduk</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.perangkat*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.perangkat.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="user-check" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Perangkat Desa</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.kontak*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.kontak.edit') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="settings" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Profil & Kontak</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="relative flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 text-vertical-menu-item-font-size font-medium transition-all duration-75 ease-linear rounded-md py-2.5 {{ request()->routeIs('admin.users*') ? 'text-custom-500 bg-custom-50 dark:bg-custom-500/10 font-semibold' : 'text-slate-600 dark:text-zink-200 hover:text-custom-500 hover:bg-slate-50 dark:hover:bg-zink-700/50' }}" href="{{ route('admin.users.index') }}">
                        <span class="min-w-[1.75rem] inline-block text-start text-[16px]"><i data-lucide="shield-alert" class="h-4"></i></span>
                        <span class="align-middle group-data-[sidebar-size=sm]:hidden">Manajemen User</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom Sidebar Quick Action -->
            <div class="p-4 mt-6 mb-4 border-t border-slate-200 dark:border-zink-600 group-data-[sidebar-size=sm]:hidden">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center w-full gap-2 px-3 py-3 text-xs font-medium text-custom-500 transition-all duration-200 rounded-lg bg-custom-50 hover:bg-custom-100 dark:bg-custom-500/10 dark:hover:bg-custom-500/20 mb-3 shadow-sm">
                    <i class="fas fa-external-link-alt" style="font-size: 14px;"></i>
                    <span>Buka Website Publik</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="
                        display: flex !important;
                        align-items: center;
                        justify-content: center;
                        width: 100%;
                        gap: 10px;
                        padding: 14px 16px;
                        font-size: 14px;
                        font-weight: 700;
                        color: #ffffff;
                        background: linear-gradient(135deg, #ef4444, #dc2626);
                        border: none;
                        border-radius: 10px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
                        letter-spacing: 0.5px;
                    " onmouseover="this.style.background='linear-gradient(135deg, #dc2626, #b91c1c)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(239, 68, 68, 0.5)';" onmouseout="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.4)';">
                        <i class="fas fa-sign-out-alt" style="font-size: 18px;"></i>
                        <span>KELUAR SISTEM</span>
                    </button>
                </form>
                <div class="mt-3 px-2 py-2 bg-slate-50 dark:bg-zink-600 rounded-lg text-center">
                    <p class="text-[10px] text-slate-400 dark:text-zink-400 mb-0.5">Login sebagai:</p>
                    <p class="text-xs font-bold text-slate-700 dark:text-zink-100 mb-0">{{ auth()->user()->name }}</p>
                    <p class="text-[9px] text-slate-400 dark:text-zink-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
<div id="sidebar-overlay" class="absolute inset-0 z-[1002] bg-slate-500/30 hidden"></div>
