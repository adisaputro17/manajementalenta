<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredikatKinerja extends Model
{
    protected $fillable = [
        'pegawai_id',
        'tahun',
        'nilai',
        'keterangan',
        'row_status',
        'approved_by',
        'approved_at',
        'reject_reason'
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
