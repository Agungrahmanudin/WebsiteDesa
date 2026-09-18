@php $kontakDesa = \App\Models\Kontak::first(); @endphp
<meta charset="utf-8">
<title>@yield('title', 'Admin Panel - Sistem Informasi ' . ($kontakDesa->nama_desa ?? 'Desa'))</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta content="Panel Administrasi Sistem Informasi {{ $kontakDesa->nama_desa ?? 'Desa' }}" name="description">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@stack('styles')
<style>
    /* Fix layout: Prevent topbar and content overlapping */
    #page-topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        height: 70px;
    }
    
    /* Main content area with proper spacing */
    .page-content-main {
        padding-top: 85px !important;
        padding-bottom: 30px;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        min-height: calc(100vh - 70px);
    }
    
    /* Sidebar positioning */
    .app-menu {
        position: fixed;
        top: 70px;
        bottom: 0;
        left: 0;
        z-index: 999;
    }
    
    /* CRUD Action Button Styles - Improved Design */
    .btn-action-view {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #16a34a;
        border: 1px solid #bbf7d0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(22, 163, 74, 0.1);
    }
    .btn-action-view:hover { 
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(22, 163, 74, 0.2);
    }
    
    .btn-action-edit {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        border: 1px solid #bfdbfe;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
    }
    .btn-action-edit:hover { 
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
    }
    
    .btn-action-delete {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        color: #dc2626;
        border: 1px solid #fecaca;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(220, 38, 38, 0.1);
    }
    .btn-action-delete:hover { 
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 38, 38, 0.2);
    }
    
    .btn-action-download {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        color: #9333ea;
        border: 1px solid #e9d5ff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(147, 51, 234, 0.1);
    }
    .btn-action-download:hover { 
        background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(147, 51, 234, 0.2);
    }
    
    .btn-action-approve {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        color: #059669;
        border: 1px solid #a7f3d0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(5, 150, 105, 0.1);
    }
    .btn-action-approve:hover { 
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(5, 150, 105, 0.2);
    }
    
    .btn-action-reject {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        width: 36px; 
        height: 36px; 
        border-radius: 8px;
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        color: #ea580c;
        border: 1px solid #fed7aa;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(234, 88, 12, 0.1);
    }
    .btn-action-reject:hover { 
        background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(234, 88, 12, 0.2);
    }
    
    /* Card improvements */
    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        overflow: hidden;
    }
    
    /* Table hover effects */
    tbody tr:hover {
        background-color: rgba(248, 250, 252, 0.5);
    }

    /* ==============================================
       UNIVERSAL ROCK-SOLID MODAL SYSTEM
       ============================================== */
    .custom-modal {
        position: fixed !important;
        inset: 0 !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.6) !important;
        backdrop-filter: blur(3px);
        z-index: 99999 !important;
        display: none !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 1rem !important;
    }
    .custom-modal.show {
        display: flex !important;
    }
    .custom-modal-dialog {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        width: 100%;
        max-width: 32rem;
        max-height: 90vh;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
        animation: customModalFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        z-index: 100000;
    }
    .dark .custom-modal-dialog {
        background: #1e293b;
        border-color: #334155;
        color: #f1f5f9;
    }
    @keyframes customModalFadeIn {
        from {
            transform: scale(0.96) translateY(-10px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    /* Clean, Professional File Input */
    .file-upload-box {
        position: relative;
        display: flex;
        align-items: center;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 5px 8px;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .file-upload-box:hover {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 1px rgba(14, 165, 233, 0.2);
    }
    .dark .file-upload-box {
        background-color: #1e293b;
        border-color: #334155;
    }
    .custom-file-input {
        width: 100%;
        font-size: 12px;
        color: #475569;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 6px 8px;
        background-color: #f8fafc;
        cursor: pointer;
    }
    .dark .custom-file-input {
        background-color: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }
    .custom-file-input::-webkit-file-upload-button {
        background: #0ea5e9;
        color: #ffffff;
        border: none;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        margin-right: 12px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .custom-file-input::-webkit-file-upload-button:hover {
        background: #0284c7;
    }
</style>
