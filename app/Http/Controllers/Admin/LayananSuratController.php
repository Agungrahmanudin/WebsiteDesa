<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananSurat;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananSuratController extends Controller
{
    public function index()
    {
        $layanan = LayananSurat::withCount('permohonan')->paginate(15);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function edit($id)
    {
        $layanan = LayananSurat::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'format_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('format_file')) {
            $filePath = $request->file('format_file')->store('format_surat', 'public');
        }

        LayananSurat::create([
            'nama_layanan' => $validated['nama_layanan'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'],
            'format_file' => $filePath,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Jenis layanan surat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananSurat::findOrFail($id);

        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'format_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $filePath = $layanan->format_file;
        if ($request->hasFile('format_file')) {
            if ($layanan->format_file && Storage::disk('public')->exists($layanan->format_file)) {
                Storage::disk('public')->delete($layanan->format_file);
            }
            $filePath = $request->file('format_file')->store('format_surat', 'public');
        }

        $layanan->update([
            'nama_layanan' => $validated['nama_layanan'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'],
            'format_file' => $filePath,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Jenis layanan surat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = LayananSurat::findOrFail($id);
        if ($layanan->format_file && Storage::disk('public')->exists($layanan->format_file)) {
            Storage::disk('public')->delete($layanan->format_file);
        }
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Jenis layanan surat berhasil dihapus!');
    }

    // Permohonan Surat methods
    public function permohonanIndex(Request $request)
    {
        $query = PermohonanSurat::with('layanan', 'user');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('layanan_id') && $request->layanan_id != '') {
            $query->where('layanan_id', $request->layanan_id);
        }

        if ($request->has('cari') && $request->cari != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_pemohon', 'like', '%' . $request->cari . '%')
                  ->orWhere('nik', 'like', '%' . $request->cari . '%');
            });
        }

        $permohonan = $query->latest()->paginate(10);
        $layananList = LayananSurat::all();

        return view('admin.layanan.permohonan', compact('permohonan', 'layananList'));
    }

    public function permohonanShow($id)
    {
        $permohonan = PermohonanSurat::with('layanan', 'user')->findOrFail($id);
        return view('admin.layanan.permohonan_show', compact('permohonan'));
    }

    public function updatePermohonan(Request $request, $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $permohonan->update($validated);

        return redirect()->route('admin.permohonan.index')->with('success', 'Status permohonan surat berhasil diupdate!');
    }

    public function destroyPermohonan($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        if ($permohonan->file_persyaratan && Storage::disk('public')->exists($permohonan->file_persyaratan)) {
            Storage::disk('public')->delete($permohonan->file_persyaratan);
        }
        $permohonan->delete();

        return redirect()->route('admin.permohonan.index')->with('success', 'Data permohonan berhasil dihapus!');
    }
}
