<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
     protected $fillable = [
        'nip',
        'nama',
        'password',
        'role',
        'jabatan',
        'unit_kerja',
        'golongan'
    ];

    protected $hidden = [
        'password',
    ];

    public function predikatKinerjas()
    {
        return $this->hasMany(
            PredikatKinerja::class
        );
    }

    public function penghargaans()
    {
        return $this->hasMany(
            Penghargaan::class
        );
    }
    
    public function penugasanTims()
    {
        return $this->hasMany(
            PenugasanTim::class
        );
    }
    
    public function pendidikanFormals()
    {
        return $this->hasMany(
            PendidikanFormal::class
        );
    }
}
