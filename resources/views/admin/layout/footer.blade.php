<footer class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm absolute right-0 bottom-0 px-4 h-14 group-data-[layout=horizontal]:ltr:left-0 group-data-[layout=horizontal]:rtl:right-0 left-0 border-t py-3 flex items-center dark:border-zink-600 bg-white dark:bg-zink-700">
    <div class="group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl w-full">
        <div class="grid items-center grid-cols-1 text-center lg:grid-cols-2 text-slate-400 dark:text-zink-200 ltr:lg:text-left rtl:lg:text-right">
            <div>
                &copy; {{ date('Y') }} Sistem Informasi Desa Cimeong.
            </div>
            <div class="hidden lg:block">
                <div class="ltr:text-right rtl:text-left">
                    Dilindungi Hak Cipta.
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Dummy elements to prevent app.js from crashing -->
<div class="hidden" style="display: none;">
    <button id="light-dark-mode"></button>
    <input type="checkbox" id="customDefaultSwitch">
    <button id="header-lang-img"></button>
</div>

<!-- StarCode JS Bundles -->
<script src="{{ asset('assets_admin/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('assets_admin/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets_admin/assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ asset('assets_admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets_admin/assets/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ asset('assets_admin/assets/js/starcode.bundle.js') }}"></script>
<script src="{{ asset('assets_admin/assets/js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Toggle mobile sidebar
        const hamburgerBtn = document.getElementById('topnav-hamburger-icon');
        const appMenu = document.querySelector('.app-menu');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (hamburgerBtn && appMenu && overlay) {
            hamburgerBtn.addEventListener('click', function() {
                appMenu.classList.toggle('hidden');
                overlay.classList.toggle('hidden');
            });
            overlay.addEventListener('click', function() {
                appMenu.classList.add('hidden');
                overlay.classList.add('hidden');
            });
        }
    });
</script>
@stack('scripts')

<script>
// Universal Rock-Solid Modal Helpers
function openCustomModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}
function closeCustomModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Close on backdrop click and Esc key
document.addEventListener('click', function(e) {
    if (e.target.classList && e.target.classList.contains('custom-modal')) {
        e.target.classList.remove('show');
        document.body.style.overflow = '';
    }
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.custom-modal.show').forEach(function(m) {
            m.classList.remove('show');
        });
        document.body.style.overflow = '';
    }
});

// Global File Input Change Handler
function handleFileChange(input) {
    var box = input.closest('.file-upload-box');
    if (box) {
        var nameEl = box.querySelector('.file-name-text');
        if (nameEl) {
            if (input.files && input.files[0]) {
                nameEl.textContent = input.files[0].name;
                nameEl.classList.remove('text-slate-400');
                nameEl.classList.add('text-custom-600', 'font-medium');
            } else {
                nameEl.textContent = 'Belum ada file dipilih';
                nameEl.classList.remove('text-custom-600', 'font-medium');
                nameEl.classList.add('text-slate-400');
            }
        }
    }
}
</script>