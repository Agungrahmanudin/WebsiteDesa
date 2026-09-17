<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:foto,video',
            'keterangan' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4|max:20480',
            'file_url' => 'nullable|string|max:255',
        ]);

        $filePath = '';
        if ($request->hasFile('file_upload')) {
            $filePath = $request->file('file_upload')->store('galeri', 'public');
        } elseif (!empty($validated['file_url'])) {
            $filePath = $validated['file_url'];
        } else {
            return back()->withErrors(['file_upload' => 'Silakan upload file foto/video atau masukkan link URL.'])->withInput();
        }

        Galeri::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'file' => $filePath,
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $item = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:foto,video',
            'keterangan' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4|max:20480',
            'file_url' => 'nullable|string|max:255',
        ]);

        $filePath = $item->file;
        if ($request->hasFile('file_upload')) {
            if ($item->file && !Str::startsWith($item->file, 'http') && Storage::disk('public')->exists($item->file)) {
                Storage::disk('public')->delete($item->file);
            }
            $filePath = $request->file('file_upload')->store('galeri', 'public');
        } elseif (!empty($validated['file_url'])) {
            $filePath = $validated['file_url'];
        }

        $item->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'file' => $filePath,
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil diperbarui!');
    }

    public function show($id)
    {
        $item = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('item'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function edit($id)
    {
        $item = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('item'));
    }

    public function destroy($id)
    {
        $item = Galeri::findOrFail($id);
        if ($item->file && !Str::startsWith($item->file, 'http') && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }
        $item->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Item galeri berhasil dihapus!');
    }
}
