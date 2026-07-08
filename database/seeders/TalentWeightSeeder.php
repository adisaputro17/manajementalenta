<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TalentWeight;

class TalentWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            // PERFORMANCE / Y

            [
                'kategori'=>'kinerja',
                'indikator'=>'Predikat Kinerja',
                'persentase'=>40
            ],

            [
                'kategori'=>'kinerja',
                'indikator'=>'Penghargaan',
                'persentase'=>30
            ],

            [
                'kategori'=>'kinerja',
                'indikator'=>'Penugasan Tim',
                'persentase'=>30
            ],



            // POTENTIAL / X

            [
                'kategori'=>'potensial',
                'indikator'=>'Pendidikan Formal',
                'persentase'=>20
            ],

            [
                'kategori'=>'potensial',
                'indikator'=>'Pengembangan Kompetensi',
                'persentase'=>20
            ],

            [
                'kategori'=>'potensial',
                'indikator'=>'Riwayat Jabatan',
                'persentase'=>25
            ],

            [
                'kategori'=>'potensial',
                'indikator'=>'Pengalaman Organisasi',
                'persentase'=>15
            ],

            [
                'kategori'=>'potensial',
                'indikator'=>'Riwayat Hukuman Disiplin',
                'persentase'=>20
            ],


        ];


        foreach($data as $item){

            TalentWeight::create($item);

        }
    }
}
