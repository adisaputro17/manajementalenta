<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendidikanFormal extends Model
{
    protected $fillable=[

    'pegawai_id',
    'tingkatan',
    'nilai',
    'jurusan',
    'universitas_sekolah',
    'tahun_lulus',
    'bukti'

];


public const LEVEL = [

    'S3'=>100,
    'S2'=>90,
    'S1'=>80,
    'D3'=>70,
    'SMA'=>60

];

public function pegawai()
{
    return $this->belongsTo(
        Pegawai::class
    );
}

}
