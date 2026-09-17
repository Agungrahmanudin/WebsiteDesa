<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $perangkat = PerangkatDesa::orderBy('urutan')->paginate(15);
        return view('admin.perangkat.index', compact('perangkat'));
    }

    public function create()
    {
        $nextUrutan = (PerangkatDesa::max('urutan') ?? 0) + 1;
        return view('admin.perangkat.create', compact('nextUrutan'));
    }

    public function edit($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return view('admin.perangkat.edit', compact('perangkat'));
    }

    public function show($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return view('admin.perangkat.show', compact('perangkat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        PerangkatDesa::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'urutan' => $validated['urutan'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $fotoPath = $perangkat->foto;
        if ($request->hasFile('foto')) {
            if ($perangkat->foto && !Str::startsWith($perangkat->foto, 'http') && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $fotoPath = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'urutan' => $validated['urutan'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        if ($perangkat->foto && !Str::startsWith($perangkat->foto, 'http') && Storage::disk('public')->exists($perangkat->foto)) {
            Storage::disk('public')->delete($perangkat->foto);
        }
        $perangkat->delete();

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil dihapus!');
    }
}
