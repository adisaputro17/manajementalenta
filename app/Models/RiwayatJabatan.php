<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    protected $fillable = [
        'pegawai_id',
        'nama_jabatan',
        'jenis_jabatan',
        'mulai_jabatan',
        'akhir_jabatan',
        'bukti'
    ];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
