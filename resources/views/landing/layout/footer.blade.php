@php
   = \App\Models\Kontak::first();
@endphp

<!-- AstroWind Footer Widget -->
<footer class="relative border-t border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 not-prose mt-20">
  <div class="dark:bg-slate-950 absolute inset-0 pointer-events-none" aria-hidden="true"></div>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 dark:text-slate-300 py-12 md:py-16">
    <div class="grid grid-cols-12 gap-6 gap-y-8 sm:gap-8 pb-10 border-b border-gray-200 dark:border-slate-800">
      
      <!-- Brand & About -->
      <div class="col-span-12 lg:col-span-4">
        <div class="mb-3">
          <a class="inline-flex items-center gap-2.5 font-bold text-xl md:text-2xl text-slate-900 dark:text-white" href="{{ route('home') }}">
            <div class="flex items-center justify-center size-9 rounded-lg bg-blue-600 text-white shadow-sm">
              <i data-lucide="landmark" class="size-5"></i>
            </div>
            <span>Desa <span class="text-blue-600">Cimeong</span></span>
          </a>
        </div>
        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 leading-relaxed pr-4">
          Pusat pelayanan administrasi dan transparansi informasi publik Pemerintah Desa Cimeong, Kecamatan Banjaran, Kabupaten Majalengka.
        </p>
        <div class="text-xs text-slate-500 dark:text-slate-400 flex flex-wrap gap-2">
          <span>Kecamatan Banjaran</span> · <span>Kabupaten Majalengka</span> · <span>Jawa Barat</span>
        </div>
      </div>

      <!-- Navigasi -->
      <div class="col-span-6 md:col-span-3 lg:col-span-2">
        <div class="text-slate-900 dark:text-gray-200 font-semibold mb-3 text-sm">Navigasi Utama</div>
        <ul class="text-sm space-y-2">
          <li><a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Beranda</a></li>
          <li><a href="{{ route('profil') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Profil Desa</a></li>
          <li><a href="{{ route('berita') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Kabar Berita</a></li>
          <li><a href="{{ route('pengumuman') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Pengumuman</a></li>
          <li><a href="{{ route('agenda') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Agenda Kegiatan</a></li>
          <li><a href="{{ route('galeri') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Galeri Foto</a></li>
        </ul>
      </div>

      <!-- Layanan Surat -->
      <div class="col-span-6 md:col-span-3 lg:col-span-3">
        <div class="text-slate-900 dark:text-gray-200 font-semibold mb-3 text-sm">Layanan Surat Mandiri</div>
        <ul class="text-sm space-y-2">
          <li><a href="{{ route('layanan') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Surat Keterangan Usaha (SKU)</a></li>
          <li><a href="{{ route('layanan') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Surat Keterangan Domisili</a></li>
          <li><a href="{{ route('layanan') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Surat Keterangan Tidak Mampu</a></li>
          <li><a href="{{ route('layanan') }}" class="text-slate-600 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition">Surat Pengantar SKCK Desa</a></li>
        </ul>
      </div>

      <!-- Kontak & Alamat -->
      <div class="col-span-12 md:col-span-6 lg:col-span-3">
        <div class="text-slate-900 dark:text-gray-200 font-semibold mb-3 text-sm">Kontak Kantor Desa</div>
        <div class="text-sm text-slate-600 dark:text-slate-400 space-y-2.5">
          <p class="flex items-start gap-2">
            <i data-lucide="map-pin" class="size-4 text-blue-600 shrink-0 mt-0.5"></i>
            <span>{{ ->alamat ?? 'Jl. Raya Balai Desa Cimeong, Kec. Banjaran, Majalengka' }}</span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="phone" class="size-4 text-blue-600 shrink-0"></i>
            <span>{{ ->no_telepon ?? '0812-3456-7890' }}</span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="mail" class="size-4 text-blue-600 shrink-0"></i>
            <span>{{ ->email ?? 'pemdes@cimeong.desa.id' }}</span>
          </p>
        </div>
      </div>

    </div>

    <!-- Bottom Copyright & Social -->
    <div class="md:flex md:items-center md:justify-between pt-6 text-sm text-slate-500 dark:text-slate-400">
      <div class="mb-4 md:mb-0">
        &copy; {{ date('Y') }} Pemerintah Desa Cimeong. Dibuat dengan template AstroWind &bull; Semua hak dilindungi.
      </div>

      @if(->facebook || ->instagram || ->youtube)
        <div class="flex items-center gap-3">
          @if(->facebook)
            <a href="{{ ->facebook }}" target="_blank" rel="noopener" aria-label="Facebook" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-blue-600 hover:text-white transition">
              <i class="fab fa-facebook-f text-xs"></i>
            </a>
          @endif
          @if(->instagram)
            <a href="{{ ->instagram }}" target="_blank" rel="noopener" aria-label="Instagram" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-blue-600 hover:text-white transition">
              <i class="fab fa-instagram text-xs"></i>
            </a>
          @endif
          @if(->youtube)
            <a href="{{ ->youtube }}" target="_blank" rel="noopener" aria-label="YouTube" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-blue-600 hover:text-white transition">
              <i class="fab fa-youtube text-xs"></i>
            </a>
          @endif
        </div>
      @endif
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('assets_admin/assets/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ asset('assets_admin/assets/js/starcode.bundle.js') }}"></script>
<script>
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>
@yield('scripts')
@stack('scripts')
