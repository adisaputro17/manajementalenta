<?php

namespace App\Services;

use App\Models\PredikatKinerja;
use App\Models\Penghargaan;
use App\Models\PenugasanTim;
use App\Models\PendidikanFormal;
use App\Models\PengembanganKompetensi;
use App\Models\RiwayatJabatan;
use App\Models\OrganisasiPegawai;
use App\Models\HukumanDisiplin;

class TalentIndicatorService
{
    public function get($pegawaiId)
    {
        return [
            // Kinerja
            [
                'nama'=>'Predikat Kinerja',
                'kategori'=>'kinerja',
                'nilai'=>$this->predikat($pegawaiId)
            ],
            [
                'nama'=>'Penghargaan',
                'kategori'=>'kinerja',
                'nilai'=>$this->penghargaan($pegawaiId)
            ],
            [
                'nama'=>'Penugasan Tim',
                'kategori'=>'kinerja',
                'nilai'=>$this->penugasan($pegawaiId)
            ],

            // Potensial
            [
                'nama'=>'Pendidikan Formal',
                'kategori'=>'potensial',
                'nilai'=>$this->pendidikan($pegawaiId)
            ],
            [
                'nama'=>'Pengembangan Kompetensi',
                'kategori'=>'potensial',
                'nilai'=>$this->kompetensi($pegawaiId)
            ],
            [
                'nama'=>'Riwayat Jabatan',
                'kategori'=>'potensial',
                'nilai'=>$this->jabatan($pegawaiId)
            ],
            [
                'nama'=>'Pengalaman Organisasi',
                'kategori'=>'potensial',
                'nilai'=>$this->organisasi($pegawaiId)
            ],
            [
                'nama'=>'Riwayat Hukuman Disiplin',
                'kategori'=>'potensial',
                'nilai'=>$this->disiplin($pegawaiId)
            ],
        ];
    }



    private function predikat($id)
    {
        return PredikatKinerja::where('pegawai_id',$id)
            ->latest()
            ->value('nilai') ?? 0;
    }

    private function penghargaan($id)
    {
        return Penghargaan::where('pegawai_id',$id)
            ->max('nilai') ?? 0;
    }

    private function penugasan($id)
    {
        return PenugasanTim::where('pegawai_id',$id)
            ->max('nilai') ?? 0;
    }

    private function pendidikan($id)
    {
        return PendidikanFormal::where('pegawai_id',$id)
            ->max('nilai') ?? 0;
    }

    private function kompetensi($id)
    {

        $jp = PengembanganKompetensi::where('pegawai_id', $id)
            ->sum('jp');

        return match(true){
            $jp > 40 => 100,
            $jp > 30 => 90,
            $jp > 20 => 80,
            $jp > 10 => 70,
            $jp >=1 => 60,

            default=>0
        };
    }

    private function jabatan($id)
    {
        $jumlah = RiwayatJabatan::where('pegawai_id', $id)
            ->count();

        return match(true){
            $jumlah >=3 =>100,
            $jumlah==2=>80,
            default=>60
        };
    }

    private function organisasi($id)
    {
        return OrganisasiPegawai::where('pegawai_id', $id)
            ->get()
            ->map(function($x){
                return match($x->peran){
                    'pimpinan'=>100,
                    'pengurus'=>80,
                    'anggota'=>60,
                    default=>0
                };
            })
            ->max() ?? 0;
    }

    private function disiplin($id)
    {
        return HukumanDisiplin::where('pegawai_id', $id)
            ->get()
            ->map(function($x){
                if($x->sedang_menjalani)
                    return 0;
                
                return match($x->jenis_hukuman){
                    'ringan'=>70,
                    'sedang'=>40,
                    'berat'=>10
                };
            })
            ->min() ?? 100;
    }
}