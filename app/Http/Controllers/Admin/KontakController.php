<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    public function edit()
    {
        $kontak = Kontak::first();
        if (!$kontak) {
            $kontak = Kontak::create([
                'nama'       => 'Pemerintah Desa Cimeong',
                'nama_desa'  => 'Desa Cimeong',
                'alamat'     => 'Jl. Raya Desa Cimeong',
                'no_telepon' => '081234567890',
                'email'      => 'pemdes@cimeong.desa.id',
            ]);
        }
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request)
    {
        $kontak = Kontak::first();

        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'nama_desa'   => 'nullable|string|max:150',
            'alamat'      => 'required|string',
            'no_telepon'  => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
            'facebook'    => 'nullable|string|max:100',
            'instagram'   => 'nullable|string|max:100',
            'youtube'     => 'nullable|string|max:100',
            'visi'        => 'nullable|string',
            'misi'        => 'nullable|string',
            'sejarah'     => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hero_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Logo upload
        if ($request->hasFile('logo')) {
            if ($kontak->logo && Storage::disk('public')->exists($kontak->logo)) {
                Storage::disk('public')->delete($kontak->logo);
            }
            $validated['logo'] = $request->file('logo')->store('kontak', 'public');
        } else {
            unset($validated['logo']);
        }

        // Hero image upload
        if ($request->hasFile('hero_image')) {
            if ($kontak->hero_image && Storage::disk('public')->exists($kontak->hero_image)) {
                Storage::disk('public')->delete($kontak->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('kontak', 'public');
        } else {
            unset($validated['hero_image']);
        }

        $kontak->update($validated);

        return back()->with('success', 'Profil dan informasi kontak desa berhasil diperbarui!');
    }
}