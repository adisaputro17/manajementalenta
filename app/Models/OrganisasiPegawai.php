<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganisasiPegawai extends Model
{
    protected $fillable = [
        'pegawai_id',
        'nama_organisasi',
        'peran',
        'tahun_mulai',
        'tahun_selesai',
        'bukti'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function getNilaiAttribute()
    {
        return match($this->peran){

            'pimpinan' => 100,

            'pengurus' => 80,

            'anggota' => 60,

            default => 0
        };
    }
}
