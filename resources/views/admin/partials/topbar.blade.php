<!-- Admin Topbar / Header -->
<header id="page-topbar" class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm fixed right-0 z-[1000] left-0 print:hidden transition-all ease-linear duration-300">
    <div class="layout-width">
        <div class="flex items-center px-4 mx-auto bg-topbar border-b border-topbar-border shadow-sm h-header dark:bg-zink-700 dark:border-zink-600">
            <div class="flex items-center w-full">
                <!-- Mobile Hamburger -->
                <button type="button" class="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-75 ease-linear bg-topbar rounded-md btn hover:bg-slate-100 dark:bg-zink-700 dark:hover:bg-zink-600 md:hidden hamburger-icon" id="topnav-hamburger-icon">
                    <i data-lucide="menu" class="size-5"></i>
                </button>

                <!-- Title breadcrumb -->
                <div class="flex items-center gap-3 ms-2 md:ms-0">
                    <h5 class="text-15 font-semibold text-slate-800 dark:text-zink-50 mb-0">
                        @yield('header-title', 'Dashboard')
                    </h5>
                </div>

                <!-- Right Topbar Items -->
                <div class="flex items-center gap-3 ms-auto">
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-custom-50 text-custom-600 dark:bg-custom-500/20 dark:text-custom-300 border border-custom-200 dark:border-custom-800 uppercase">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </span>

                    <div class="relative flex items-center dropdown h-header">
                        <button type="button" class="inline-flex items-center gap-2 p-1.5 transition-all duration-200 ease-linear rounded-lg dropdown-toggle btn hover:bg-slate-100 dark:hover:bg-zink-600" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <div class="flex items-center justify-center size-8 rounded-full bg-custom-500 text-white font-bold text-sm">
                                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <div class="hidden text-start md:block">
                                <h6 class="mb-0 text-sm font-medium text-slate-700 dark:text-zink-100">{{ auth()->user()->name ?? 'Administrator' }}</h6>
                                <p class="mb-0 text-xs text-slate-400 dark:text-zink-300">{{ auth()->user()->email ?? ($kontakDesa->email ?? 'admin@desa.id') }}</p>
                            </div>
                            <i data-lucide="chevron-down" class="size-4 text-slate-400 hidden md:block"></i>
                        </button>
                        <div class="absolute z-50 hidden p-3 ltr:text-left rtl:text-right bg-white rounded-md shadow-lg !top-4 dropdown-menu min-w-[12rem] dark:bg-zink-600 border border-slate-200 dark:border-zink-500" aria-labelledby="dropdownMenuButton">
                            <div class="px-3 py-2 border-b border-slate-200 dark:border-zink-500 mb-2">
                                <p class="text-xs text-slate-400 mb-0">Masuk sebagai</p>
                                <p class="text-sm font-semibold text-slate-700 dark:text-zink-100 mb-0">{{ auth()->user()->name }}</p>
                            </div>
                            <ul>
                                <li>
                                    <a class="flex items-center gap-2 px-3 py-1.5 text-sm transition-all duration-200 rounded-md text-slate-600 dropdown-item hover:text-custom-500 hover:bg-slate-50 dark:text-zink-200 dark:hover:bg-zink-500" href="{{ route('admin.kontak.edit') }}">
                                        <i data-lucide="settings" class="size-4"></i> Pengaturan
                                    </a>
                                </li>
                                <li>
                                    <a class="flex items-center gap-2 px-3 py-1.5 text-sm transition-all duration-200 rounded-md text-slate-600 dropdown-item hover:text-custom-500 hover:bg-slate-50 dark:text-zink-200 dark:hover:bg-zink-500" href="{{ route('home') }}" target="_blank">
                                        <i data-lucide="globe" class="size-4"></i> Website Publik
                                    </a>
                                </li>
                                <li class="pt-2 mt-2 border-t border-slate-200 dark:border-zink-500">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-3 py-1.5 text-sm font-medium transition-all duration-200 rounded-md text-red-500 dropdown-item hover:bg-red-50 dark:hover:bg-red-500/10">
                                            <i data-lucide="log-out" class="size-4"></i> Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
