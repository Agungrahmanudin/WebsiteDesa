<!DOCTYPE html>
<html lang="id" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    @include('admin.layout.head')
</head>

<body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
<div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">

    <!-- 1. Sidebar Component -->
    @include('admin.partials.sidebar')

    <div id="sidebar-overlay" class="absolute inset-0 z-[1002] bg-slate-500/30 hidden"></div>

    <!-- 2. Topbar / Header Component -->
    @include('admin.partials.topbar')

    <!-- Page Content Wrapper -->
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="page-content-main group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                
                <!-- Flash Alerts -->
                @if(session('success'))
                    <div class="flex items-center justify-between p-4 mb-5 text-sm text-green-700 bg-green-50 rounded-lg border border-green-200 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-400" role="alert">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="size-5 shrink-0 text-green-600"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="text-green-500 hover:text-green-700" onclick="this.parentElement.remove()"><i data-lucide="x" class="size-4"></i></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center justify-between p-4 mb-5 text-sm text-red-700 bg-red-50 rounded-lg border border-red-200 dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-400" role="alert">
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-triangle" class="size-5 shrink-0 text-red-600"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()"><i data-lucide="x" class="size-4"></i></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <!-- 3. Footer Component -->
        @include('admin.layout.footer')
    </div>
</div>

</body>
</html>
