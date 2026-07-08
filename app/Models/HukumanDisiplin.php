<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HukumanDisiplin extends Model
{
    protected $fillable = [
        'pegawai_id',
        'jenis_hukuman',
        'tanggal_mulai',
        'tanggal_selesai',
        'sedang_menjalani',
        'nomor_sk',
        'bukti'

    ];

    protected $casts = [
        'sedang_menjalani'=>'boolean'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function getNilaiAttribute()
    {

        if($this->sedang_menjalani){
            return 0;
        }


        return match($this->jenis_hukuman){

            'ringan'=>70,

            'sedang'=>40,

            'berat'=>10,

            default=>100
        };

    }
}
