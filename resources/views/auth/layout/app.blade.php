<!DOCTYPE html>
<html lang="id" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    @php $kontakDesa = \App\Models\Kontak::first(); @endphp
    <meta charset="utf-8">
    <title>@yield('title', 'Autentikasi | Sistem Informasi ' . ($kontakDesa->nama_desa ?? 'Desa'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Sistem Informasi dan Pelayanan Publik {{ $kontakDesa->nama_desa ?? 'Desa' }}" name="description">
    <meta content="{{ $kontakDesa->nama_desa ?? 'Desa' }}" name="author">
    <!-- App favicon -->
    @if($kontakDesa && $kontakDesa->logo)
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $kontakDesa->logo) }}">
    @else
    <link rel="shortcut icon" href="{{ asset('assets_admin/assets/images/favicon.ico') }}">
    @endif
    <!-- Layout config Js -->
    <script src="{{ asset('assets_admin/assets/js/layout.js') }}"></script>
    <!-- StarCode CSS -->
    <link rel="stylesheet" href="{{ asset('assets_admin/assets/css/starcode2.css') }}">
    @stack('styles')
</head>

<body class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover dark:text-zink-100 font-public" style="background-image: url('{{ asset('assets_admin/assets/images/auth-bg.jpg') }}'); background-size: cover; background-position: center;">

    @yield('content')

    <script src='{{ asset('assets_admin/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
    <script src="{{ asset('assets_admin/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets_admin/assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('assets_admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets_admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets_admin/assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ asset('assets_admin/assets/js/starcode.bundle.js') }}"></script>
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
    @stack('scripts')
</body>
</html>
