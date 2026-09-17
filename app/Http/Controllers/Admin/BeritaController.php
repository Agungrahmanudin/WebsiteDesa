<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with('kategori', 'tags');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('cari') && $request->cari != '') {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        $berita = $query->latest()->paginate(10);
        $kategoriList = KategoriBerita::all();

        return view('admin.berita.index', compact('berita', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = KategoriBerita::all();
        $tagList = Tag::all();
        return view('admin.berita.create', compact('kategoriList', 'tagList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'isi' => 'required|string',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'tags' => 'nullable|array',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $slug = Str::slug($validated['judul']);
        $count = Berita::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . time();
        }

        $berita = Berita::create([
            'kategori_id' => $validated['kategori_id'],
            'judul' => $validated['judul'],
            'slug' => $slug,
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'gambar' => $gambarPath,
        ]);

        if (!empty($request->tags)) {
            $berita->tags()->sync($request->tags);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function show($id)
    {
        $berita = Berita::with('kategori', 'tags')->findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::with('tags')->findOrFail($id);
        $kategoriList = KategoriBerita::all();
        $tagList = Tag::all();
        return view('admin.berita.edit', compact('berita', 'kategoriList', 'tagList'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_berita,id',
            'isi' => 'required|string',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'tags' => 'nullable|array',
        ]);

        $gambarPath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && !Str::startsWith($berita->gambar, 'http') && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'kategori_id' => $validated['kategori_id'],
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'status' => $validated['status'],
            'gambar' => $gambarPath,
        ]);

        if ($request->has('tags')) {
            $berita->tags()->sync($request->tags);
        } else {
            $berita->tags()->detach();
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if ($berita->gambar && !Str::startsWith($berita->gambar, 'http') && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->tags()->detach();
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
