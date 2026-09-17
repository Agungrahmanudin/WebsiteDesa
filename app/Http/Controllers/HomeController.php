<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        $beritaTerbaru = Berita::with('kategori')->where('status', 'publish')->latest()->take(6)->get();
        $pengumuman = Pengumuman::where('status', 'aktif')->latest()->take(5)->get();
        $agenda = Agenda::latest()->take(4)->get();
        $galeri = Galeri::latest()->take(6)->get();
        $perangkat = PerangkatDesa::orderBy('urutan')->get();
        $layanan = LayananSurat::all();

        // Statistik untuk Hero Section
        $totalPenduduk = DataPenduduk::count();
        $totalBerita = Berita::where('status', 'publish')->count();
        $totalAgenda = Agenda::count();
        $totalPengumuman = Pengumuman::where('status', 'aktif')->count();
        $totalLaki = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = DataPenduduk::where('jenis_kelamin', 'P')->count();
        $totalRT = DataPenduduk::distinct('rt')->count('rt');
        $totalRW = DataPenduduk::distinct('rw')->count('rw');

        return view('landing.index', compact(
            'kontak',
            'beritaTerbaru',
            'pengumuman',
            'agenda',
            'galeri',
            'perangkat',
            'layanan',
            'totalPenduduk',
            'totalBerita',
            'totalAgenda',
            'totalPengumuman',
            'totalLaki',
            'totalPerempuan',
            'totalRT',
            'totalRW'
        ));
    }

    public function profil()
    {
        $kontak = Kontak::first();
        $perangkat = PerangkatDesa::orderBy('urutan')->get();
        $totalPenduduk = DataPenduduk::count();
        $totalLaki = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = DataPenduduk::where('jenis_kelamin', 'P')->count();

        return view('landing.profil', compact('kontak', 'perangkat', 'totalPenduduk', 'totalLaki', 'totalPerempuan'));
    }

    public function berita(Request $request)
    {
        $kontak = Kontak::first();
        $kategoriList = KategoriBerita::withCount(['berita' => function($q) {
            $q->where('status', 'publish');
        }])->get();

        $query = Berita::with('kategori', 'tags')->where('status', 'publish');

        if ($request->has('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->has('cari')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->cari . '%')
                  ->orWhere('isi', 'like', '%' . $request->cari . '%');
            });
        }

        $berita = $query->latest()->paginate(9);
        return view('landing.berita', compact('kontak', 'kategoriList', 'berita'));
    }

    public function detailBerita($slug)
    {
        $kontak = Kontak::first();
        $berita = Berita::with('kategori', 'tags')->where('slug', $slug)->firstOrFail();
        $beritaLainnya = Berita::where('id', '!=', $berita->id)->where('status', 'publish')->latest()->take(4)->get();
        $kategoriList = KategoriBerita::withCount('berita')->get();

        return view('landing.detail_berita', compact('kontak', 'berita', 'beritaLainnya', 'kategoriList'));
    }

    public function pengumuman()
    {
        $kontak = Kontak::first();
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('landing.pengumuman', compact('kontak', 'pengumuman'));
    }

    public function agenda()
    {
        $kontak = Kontak::first();
        $agenda = Agenda::latest()->paginate(10);
        return view('landing.agenda', compact('kontak', 'agenda'));
    }

    public function galeri()
    {
        $kontak = Kontak::first();
        $galeri = Galeri::latest()->paginate(12);
        return view('landing.galeri', compact('kontak', 'galeri'));
    }

    public function detailGaleri($id)
    {
        $kontak = Kontak::first();
        $item = Galeri::findOrFail($id);
        $galeriLainnya = Galeri::where('id', '!=', $item->id)->latest()->take(6)->get();
        return view('landing.detail_galeri', compact('kontak', 'item', 'galeriLainnya'));
    }

    public function layanan()
    {
        $kontak = Kontak::first();
        $layananList = LayananSurat::all();
        return view('landing.layanan', compact('kontak', 'layananList'));
    }

    public function simpanPermohonan(Request $request)
    {
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanan_surat,id',
            'nama_pemohon' => 'required|string|max:100',
            'nik' => 'required|string|max:20',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'file_persyaratan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('file_persyaratan')) {
            $file = $request->file('file_persyaratan');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('persyaratan', $fileName, 'public');
        }

        PermohonanSurat::create([
            'layanan_id' => $validated['layanan_id'],
            'user_id' => auth()->id() ?? null,
            'nama_pemohon' => $validated['nama_pemohon'],
            'nik' => $validated['nik'],
            'alamat' => $validated['alamat'],
            'keperluan' => $validated['keperluan'],
            'file_persyaratan' => $filePath,
            'status' => 'menunggu',
            'catatan' => 'Permohonan berhasil dikirim secara online.',
        ]);

        return back()->with('success', 'Permohonan surat Anda berhasil dikirim! Petugas kami akan segera memprosesnya.');
    }

    public function kontak()
    {
        $kontak = Kontak::first();
        return view('landing.kontak', compact('kontak'));
    }
}
