<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananSurat extends Model
{
    use HasFactory;

    protected $table = 'layanan_surat';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'persyaratan',
        'format_file',
    ];

    public function permohonan()
    {
        return $this->hasMany(PermohonanSurat::class, 'layanan_id');
    }
}
