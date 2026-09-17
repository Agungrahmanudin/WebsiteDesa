<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'nama',
        'nama_desa',
        'logo',
        'hero_image',
        'visi',
        'misi',
        'sejarah',
        'alamat',
        'no_telepon',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'jadwal_senin_kamis',
        'jadwal_jumat',
        'jadwal_weekend',
    ];
}
