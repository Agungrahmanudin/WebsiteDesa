<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta content="Sistem Informasi dan Pelayanan Publik Desa Cimeong" name="description">
<meta content="Pemerintah Desa Cimeong" name="author">

<title>@yield('title', 'Website Resmi Desa Cimeong')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets_admin/assets/images/favicon.ico') }}">

<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Tailwind & StarCode CSS -->
<link rel="stylesheet" href="{{ asset('assets_admin/assets/css/starcode2.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- AstroWind Theme Variables & Custom Styles -->
<style>
    :root {
        --aw-font-sans: 'Inter', system-ui, sans-serif;
        --aw-color-primary: rgb(1 97 239);
        --aw-color-secondary: rgb(1 84 207);
        --aw-color-accent: rgb(109 40 217);
        --aw-color-text-heading: rgb(0 0 0);
        --aw-color-text-default: rgb(16 16 16);
        --aw-color-text-muted: rgb(16 16 16 / 66%);
        --aw-color-bg-page: rgb(255 255 255);
        --aw-color-bg-page-dark: rgb(3 6 32);
    }
    .dark {
        --aw-color-text-heading: rgb(247, 248, 248);
        --aw-color-text-default: rgb(229 236 246);
        --aw-color-text-muted: rgb(229 236 246 / 66%);
        --aw-color-bg-page: rgb(3 6 32);
    }
    body {
        font-family: var(--aw-font-sans);
        color: var(--aw-color-text-default);
        background-color: var(--aw-color-bg-page);
    }
    .bg-page {
        background-color: var(--aw-color-bg-page);
    }
    .text-muted {
        color: var(--aw-color-text-muted);
    }
    .text-primary-astrowind {
        color: var(--aw-color-primary);
    }
    .btn-astrowind-primary {
        background-color: var(--aw-color-primary);
        color: #ffffff;
        transition: all 0.2s ease-in-out;
    }
    .btn-astrowind-primary:hover {
        background-color: var(--aw-color-secondary);
    }
</style>

@stack('styles')
@yield('additional_css')
