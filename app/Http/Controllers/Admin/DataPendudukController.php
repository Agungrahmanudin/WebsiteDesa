<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = DataPenduduk::query();

        if ($request->has('cari') && $request->cari != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('nik', 'like', '%' . $request->cari . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $request->cari . '%');
            });
        }

        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        $penduduk = $query->latest()->paginate(10);
        $totalPenduduk = DataPenduduk::count();
        $totalLaki = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = DataPenduduk::where('jenis_kelamin', 'P')->count();

        return view('admin.penduduk.index', compact('penduduk', 'totalPenduduk', 'totalLaki', 'totalPerempuan'));
    }

    public function create()
    {
        return view('admin.penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:data_penduduk,nik',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'status_keluarga' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
        ]);

        DataPenduduk::create($validated);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        return view('admin.penduduk.show', compact('penduduk'));
    }

    public function edit($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:data_penduduk,nik,' . $id,
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'status_keluarga' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'agama' => 'required|string|max:50',
        ]);

        $penduduk->update($validated);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }
}
