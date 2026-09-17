<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\DataPenduduk;
use App\Models\Galeri;
use App\Models\KategoriBerita;
use App\Models\Kontak;
use App\Models\LayananSurat;
use App\Models\Pengumuman;
use App\Models\PerangkatDesa;
use App\Models\PermohonanSurat;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles
        $rolesData = [
            ['name' => 'Super Admin', 'slug' => 'super_admin', 'description' => 'Akses penuh seluruh sistem'],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator Website Desa'],
            ['name' => 'Operator', 'slug' => 'operator', 'description' => 'Operator pelayanan surat dan kependudukan'],
            ['name' => 'Editor', 'slug' => 'editor', 'description' => 'Editor berita, galeri, dan pengumuman'],
            ['name' => 'User', 'slug' => 'user', 'description' => 'Warga / pengguna umum'],
        ];
        $roles = [];
        foreach ($rolesData as $r) {
            $roles[$r['slug']] = Role::create($r);
        }

        // 2. Users & User Profiles
        $adminUser = User::create([
            'name' => 'Administrator Desa Cimeong',
            'email' => 'admin@desacimeong.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => 1,
            'avatar' => null,
            'last_login' => now(),
        ]);
        $adminUser->roles()->attach($roles['admin']->id);

        $adminUser2 = User::create([
            'name' => 'Administrator Desa',
            'email' => 'admin@desa.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => 1,
            'avatar' => null,
            'last_login' => now(),
        ]);
        $adminUser2->roles()->attach($roles['admin']->id);

        UserProfile::create([
            'user_id' => $adminUser->id,
            'nik' => '3201010101900001',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Kuningan',
            'tanggal_lahir' => '1990-05-15',
            'alamat' => 'Jl. Balai Desa Cimeong No. 01, RT 01 / RW 01',
            'no_hp' => '081234567890',
            'foto' => null,
        ]);

        $wargaUser = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'warga@desa.id',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_active' => 1,
            'avatar' => null,
            'last_login' => now(),
        ]);
        $wargaUser->roles()->attach($roles['user']->id);

        UserProfile::create([
            'user_id' => $wargaUser->id,
            'nik' => '3201011202880002',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Kuningan',
            'tanggal_lahir' => '1988-02-12',
            'alamat' => 'Dusun Manis, RT 02 / RW 01 Desa Cimeong',
            'no_hp' => '085712345678',
            'foto' => null,
        ]);

        // 3. Kontak
        Kontak::create([
            'nama' => 'Pemerintah Desa Cimeong',
            'alamat' => 'Jl. Raya Desa Cimeong, Kec. Banjaran, Majalengka, Jawa Barat',
            'no_telepon' => '081234567890',
            'email' => 'pemdes@cimeong.desa.id',
            'facebook' => 'https://facebook.com/desacimeong',
            'instagram' => 'https://instagram.com/desacimeong',
            'youtube' => 'https://youtube.com/@desacimeong',
        ]);

        // 4. Kategori Berita & Tags
        $katPembangunan = KategoriBerita::create([
            'nama_kategori' => 'Pembangunan Desa',
            'slug' => 'pembangunan-desa',
            'deskripsi' => 'Informasi pembangunan infrastruktur dan fasilitas desa',
        ]);
        $katSosial = KategoriBerita::create([
            'nama_kategori' => 'Sosial & Budaya',
            'slug' => 'sosial-dan-budaya',
            'deskripsi' => 'Kegiatan kebudayaan, keagamaan, dan gotong royong warga',
        ]);
        $katEkonomi = KategoriBerita::create([
            'nama_kategori' => 'Ekonomi & BUMDes',
            'slug' => 'ekonomi-dan-bumdes',
            'deskripsi' => 'Perkembangan ekonomi warga, pertanian, dan unit usaha desa',
        ]);

        $tag1 = Tag::create(['nama_tag' => 'Gotong Royong', 'slug' => 'gotong-royong']);
        $tag2 = Tag::create(['nama_tag' => 'Dana Desa', 'slug' => 'dana-desa']);
        $tag3 = Tag::create(['nama_tag' => 'Pelayanan Publik', 'slug' => 'pelayanan-publik']);
        $tag4 = Tag::create(['nama_tag' => 'Pertanian', 'slug' => 'pertanian']);

        // 5. Berita
        $b1 = Berita::create([
            'kategori_id' => $katPembangunan->id,
            'judul' => 'Pembangunan Jalan Usaha Tani Dusun Manis Rampung 100%',
            'slug' => 'pembangunan-jalan-usaha-tani-dusun-manis-rampung-100',
            'isi' => 'Pemerintah Desa Cimeong berhasil menyelesaikan pengaspalan jalan usaha tani di Dusun Manis sepanjang 800 meter yang bersumber dari alokasi Dana Desa tahun ini. Diharapkan jalan ini mempermudah mobilitas petani mengangkut hasil panen padi dan palawija secara optimal.',
            'gambar' => null,
            'status' => 'publish',
        ]);
        $b1->tags()->attach([$tag1->id, $tag2->id]);

        $b2 = Berita::create([
            'kategori_id' => $katSosial->id,
            'judul' => 'Warga Desa Cimeong Guyub dalam Bersih Desa dan Santunan Anak Yatim',
            'slug' => 'warga-desa-cimeong-guyub-dalam-bersih-desa-dan-santunan-anak-yatim',
            'isi' => 'Kegiatan tahunan Bersih Desa Cimeong kembali digelar dengan penuh kekhidmatan. Acara dimulai dengan kerja bakti serentak di seluruh lingkungan RT, doa bersama di Balai Desa, dan diakhiri dengan santunan kepada 50 anak yatim piatu.',
            'gambar' => null,
            'status' => 'publish',
        ]);
        $b2->tags()->attach([$tag1->id]);

        $b3 = Berita::create([
            'kategori_id' => $katEkonomi->id,
            'judul' => 'BUMDes Cimeong Mandiri Luncurkan Program Pupuk Organik Murah',
            'slug' => 'bumdes-cimeong-mandiri-luncurkan-program-pupuk-organik-murah',
            'isi' => 'Untuk mendukung ketahanan pangan dan menekan biaya produksi pertanian lokal, BUMDes bekerjasama dengan kelompok tani memproduksi pupuk organik ramah lingkungan dengan harga terjangkau bagi seluruh warga desa.',
            'gambar' => null,
            'status' => 'publish',
        ]);
        $b3->tags()->attach([$tag4->id]);

        // 6. Pengumuman
        Pengumuman::create([
            'judul' => 'Jadwal Penyaluran Bantuan Langsung Tunai (BLT) Dana Desa Triwulan III',
            'isi' => 'Diberitahukan kepada Keluarga Penerima Manfaat (KPM) BLT Desa Cimeong bahwa penyaluran akan dilaksanakan pada hari Kamis di Aula Balai Desa mulai pukul 08.30 WIB. Harap membawa KTP Asli dan KK.',
            'tanggal_mulai' => now()->toDateString(),
            'tanggal_selesai' => now()->addDays(7)->toDateString(),
            'status' => 'aktif',
            'gambar' => null,
        ]);

        Pengumuman::create([
            'judul' => 'Pelayanan Perekaman KTP Elektronik & Pembuatan KIA Keliling',
            'isi' => 'Disdukcapil bekerjasama dengan Pemerintah Desa Cimeong membuka loket pelayanan adminduk keliling hari Sabtu depan di halaman kantor desa.',
            'tanggal_mulai' => now()->subDays(2)->toDateString(),
            'tanggal_selesai' => now()->addDays(5)->toDateString(),
            'status' => 'aktif',
            'gambar' => null,
        ]);

        // 7. Agenda
        Agenda::create([
            'judul' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) 2027',
            'deskripsi' => 'Penyusunan RKPDes dan pembahasan usulan pembangunan skala prioritas dari masing-masing dusun bersama BPD dan tokoh masyarakat.',
            'tanggal_mulai' => now()->addDays(5)->toDateString(),
            'tanggal_selesai' => now()->addDays(5)->toDateString(),
            'lokasi' => 'Aula Balai Desa Cimeong',
            'status' => 'akan',
            'gambar' => null,
        ]);

        Agenda::create([
            'judul' => 'Posyandu Balita dan Lansia Serentak Seluruh Dusun',
            'deskripsi' => 'Pemeriksaan kesehatan gratis, penimbangan balita, imunisasi, dan pemberian makanan tambahan (PMT) bergizi.',
            'tanggal_mulai' => now()->addDays(10)->toDateString(),
            'tanggal_selesai' => now()->addDays(10)->toDateString(),
            'lokasi' => 'Posyandu Teratai & Mawar Desa Cimeong',
            'status' => 'akan',
            'gambar' => null,
        ]);

        Agenda::create([
            'judul' => 'Turnamen Sepak Bola Antar RW Cup Cimeong',
            'deskripsi' => 'Ajang silaturahmi pemuda dan olahraga memperingati HUT kemerdekaan.',
            'tanggal_mulai' => now()->subDays(15)->toDateString(),
            'tanggal_selesai' => now()->subDays(10)->toDateString(),
            'lokasi' => 'Lapangan Gelora Cimeong',
            'status' => 'terlaksana',
            'gambar' => null,
        ]);

        // 8. Galeri
        Galeri::create([
            'judul' => 'Gotong Royong Perbaikan Saluran Irigasi Sawah',
            'kategori' => 'foto',
            'file' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&auto=format&fit=crop&q=60',
            'keterangan' => 'Kebersamaan warga membersihkan saluran air pertanian menjelang musim tanam.',
        ]);
        Galeri::create([
            'judul' => 'Pelatihan Digitalisasi UMKM Ibu-Ibu PKK',
            'kategori' => 'foto',
            'file' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&auto=format&fit=crop&q=60',
            'keterangan' => 'Pelatihan pemasaran produk olahan pangan desa melalui platform digital.',
        ]);
        Galeri::create([
            'judul' => 'Pemandangan Panorama Alam Perbukitan Cimeong',
            'kategori' => 'foto',
            'file' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&auto=format&fit=crop&q=60',
            'keterangan' => 'Pesona alam asri perbukitan dan persawahan Desa Cimeong.',
        ]);

        // 9. Layanan Surat
        $surat1 = LayananSurat::create([
            'nama_layanan' => 'Surat Keterangan Usaha (SKU)',
            'deskripsi' => 'Surat keterangan untuk keperluan izin usaha mikro atau pengajuan kredit perbankan.',
            'persyaratan' => 'Fotokopi KTP, KK, dan bukti foto lokasi/kegiatan usaha.',
            'format_file' => null,
        ]);
        $surat2 = LayananSurat::create([
            'nama_layanan' => 'Surat Keterangan Tidak Mampu (SKTM)',
            'deskripsi' => 'Surat keterangan untuk keperluan beasiswa sekolah atau pengobatan BPJS PBI.',
            'persyaratan' => 'Fotokopi KTP, KK, Surat Pengantar RT/RW setempat.',
            'format_file' => null,
        ]);
        $surat3 = LayananSurat::create([
            'nama_layanan' => 'Surat Pengantar Pembuatan SKCK',
            'deskripsi' => 'Surat rekomendasi desa untuk pengurusan SKCK di Polsek / Polres.',
            'persyaratan' => 'Fotokopi KTP, KK, Akta Kelahiran, dan Pas Foto 4x6 (2 lembar).',
            'format_file' => null,
        ]);
        $surat4 = LayananSurat::create([
            'nama_layanan' => 'Surat Keterangan Domisili',
            'deskripsi' => 'Surat keterangan tempat tinggal / domisili resmi warga di Desa Cimeong.',
            'persyaratan' => 'Fotokopi KTP, KK, surat pengantar dari RT/RW.',
            'format_file' => null,
        ]);

        // 10. Permohonan Surat (Contoh)
        PermohonanSurat::create([
            'layanan_id' => $surat1->id,
            'user_id' => $wargaUser->id,
            'nama_pemohon' => 'Ahmad Fauzi',
            'nik' => '3201011202880002',
            'alamat' => 'Dusun Manis, RT 02 / RW 01 Desa Cimeong',
            'keperluan' => 'Pengajuan KUR BRI untuk usaha toko kelontong & sembako',
            'file_persyaratan' => null,
            'status' => 'diproses',
            'catatan' => 'Berkas persyaratan lengkap, sedang menunggu tanda tangan Kepala Desa.',
        ]);

        PermohonanSurat::create([
            'layanan_id' => $surat2->id,
            'user_id' => null,
            'nama_pemohon' => 'Siti Rohmah',
            'nik' => '3201015507950003',
            'alamat' => 'Dusun Pahing, RT 04 / RW 02 Desa Cimeong',
            'keperluan' => 'Permohonan Beasiswa KIP Kuliah anak di Universitas',
            'file_persyaratan' => null,
            'status' => 'selesai',
            'catatan' => 'Surat sudah selesai dicetak dan dapat diambil di loket pelayanan Balai Desa.',
        ]);

        // 11. Perangkat Desa
        PerangkatDesa::create([
            'nama' => 'H. Suherman, S.Pd',
            'jabatan' => 'Kepala Desa',
            'foto' => null,
            'urutan' => 1,
        ]);
        PerangkatDesa::create([
            'nama' => 'Dedi Mulyadi, S.AP',
            'jabatan' => 'Sekretaris Desa',
            'foto' => null,
            'urutan' => 2,
        ]);
        PerangkatDesa::create([
            'nama' => 'Iwan Setiawan',
            'jabatan' => 'Kaur Keuangan (Bendahara)',
            'foto' => null,
            'urutan' => 3,
        ]);
        PerangkatDesa::create([
            'nama' => 'Rina Marlina, S.Pd',
            'jabatan' => 'Kaur Tata Usaha & Umum',
            'foto' => null,
            'urutan' => 4,
        ]);
        PerangkatDesa::create([
            'nama' => 'Budi Santoso',
            'jabatan' => 'Kasi Pemerintahan',
            'foto' => null,
            'urutan' => 5,
        ]);
        PerangkatDesa::create([
            'nama' => 'Nanang Hidayat',
            'jabatan' => 'Kasi Kesejahteraan',
            'foto' => null,
            'urutan' => 6,
        ]);
        PerangkatDesa::create([
            'nama' => 'Agus Priyanto',
            'jabatan' => 'Kepala Dusun Manis',
            'foto' => null,
            'urutan' => 7,
        ]);

        // 12. Data Penduduk (Sampel data kependudukan)
        $pendudukList = [
            ['nik' => '3201010101900001', 'nama' => 'H. Suherman', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Kuningan', 'tanggal_lahir' => '1975-08-17', 'alamat' => 'Jl. Balai Desa', 'rt' => '01', 'rw' => '01', 'status_keluarga' => 'Kepala Keluarga', 'pekerjaan' => 'PNS / Perangkat Desa', 'agama' => 'Islam'],
            ['nik' => '3201011202880002', 'nama' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Kuningan', 'tanggal_lahir' => '1988-02-12', 'alamat' => 'Dusun Manis', 'rt' => '02', 'rw' => '01', 'status_keluarga' => 'Kepala Keluarga', 'pekerjaan' => 'Wiraswasta', 'agama' => 'Islam'],
            ['nik' => '3201015507950003', 'nama' => 'Siti Rohmah', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Majalengka', 'tanggal_lahir' => '1995-07-15', 'alamat' => 'Dusun Pahing', 'rt' => '04', 'rw' => '02', 'status_keluarga' => 'Ibu Rumah Tangga', 'pekerjaan' => 'Pedagang', 'agama' => 'Islam'],
            ['nik' => '3201011003010004', 'nama' => 'Rizky Pratama', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Kuningan', 'tanggal_lahir' => '2001-03-10', 'alamat' => 'Dusun Wage', 'rt' => '01', 'rw' => '03', 'status_keluarga' => 'Anak', 'pekerjaan' => 'Mahasiswa', 'agama' => 'Islam'],
            ['nik' => '3201012509650005', 'nama' => 'Siti Aminah', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Kuningan', 'tanggal_lahir' => '1965-09-25', 'alamat' => 'Dusun Kliwon', 'rt' => '03', 'rw' => '02', 'status_keluarga' => 'Istri', 'pekerjaan' => 'Petani', 'agama' => 'Islam'],
            ['nik' => '3201011111920006', 'nama' => 'Cecep Supriatna', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Kuningan', 'tanggal_lahir' => '1992-11-11', 'alamat' => 'Dusun Manis', 'rt' => '03', 'rw' => '01', 'status_keluarga' => 'Kepala Keluarga', 'pekerjaan' => 'Buruh Harian Lepas', 'agama' => 'Islam'],
        ];

        foreach ($pendudukList as $p) {
            DataPenduduk::create($p);
        }
    }
}
