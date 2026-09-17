<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\DataPenduduk;
use App\Models\Galeri;
use App\Models\LayananSurat;
use App\Models\Pengumuman;
use App\Models\PerangkatDesa;
use App\Models\PermohonanSurat;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalAgenda = Agenda::count();
        $totalPengumuman = Pengumuman::count();
        $totalGaleri = Galeri::count();
        $totalPenduduk = DataPenduduk::count();
        $totalLayanan = LayananSurat::count();
        $totalPermohonan = PermohonanSurat::count();
        $totalPerangkat = PerangkatDesa::count();
        $totalUser = User::count();

        $permohonanMenunggu = PermohonanSurat::where('status', 'menunggu')->count();
        $permohonanDiproses = PermohonanSurat::where('status', 'diproses')->count();
        $permohonanSelesai = PermohonanSurat::where('status', 'selesai')->count();

        $permohonanTerbaru = PermohonanSurat::with('layanan')->latest()->take(5)->get();
        $beritaTerbaru = Berita::with('kategori')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalAgenda',
            'totalPengumuman',
            'totalGaleri',
            'totalPenduduk',
            'totalLayanan',
            'totalPermohonan',
            'totalPerangkat',
            'totalUser',
            'permohonanMenunggu',
            'permohonanDiproses',
            'permohonanSelesai',
            'permohonanTerbaru',
            'beritaTerbaru'
        ));
    }
}
