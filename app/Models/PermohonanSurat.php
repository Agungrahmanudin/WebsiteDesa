<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';

    protected $fillable = [
        'layanan_id',
        'user_id',
        'nama_pemohon',
        'nik',
        'alamat',
        'keperluan',
        'file_persyaratan',
        'status',
        'catatan',
    ];

    public function layanan()
    {
        return $this->belongsTo(LayananSurat::class, 'layanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
