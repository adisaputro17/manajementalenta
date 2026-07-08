<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    protected $fillable=[
        'pegawai_id',
        'jenis',
        'tingkatan',
        'nilai',
        'nama_penghargaan',
        'pemberi',
        'tahun',
        'bukti',
        'row_status',
        'approved_by',
        'approved_at',
        'reject_reason'
    ];
    
    public const LEVEL = [
        'Internasional'=>100,
        'Nasional'=>80,
        'Regional'=>60,
        'Instansi'=>40,
        'Unit Kerja'=>20,
        'Tidak Pernah Mendapat Penghargaan'=>0
    ];
    
    public function pegawai()
    {
        return $this->belongsTo(
            Pegawai::class
        );
    }

    public function approver()
    {
        return $this->belongsTo(Pegawai::class, 'approved_by');
    }

}
