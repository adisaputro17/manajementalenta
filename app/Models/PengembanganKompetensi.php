<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembanganKompetensi extends Model
{
    protected $fillable = [
        'pegawai_id',
        'jp',
        'kegiatan',
        'penyelenggara',
        'tahun',
        'bukti'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
