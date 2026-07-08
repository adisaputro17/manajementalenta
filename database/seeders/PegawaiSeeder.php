<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            [
                'nip' => '199501232020121002',
                'nama' => 'INDRA PRASETYO',
                'password' => 'admin123',
                'role' => 'ADMIN',
            ],
            [
                'nip' => '199901302024211002',
                'nama' => 'ADHI DWI SAPUTRO',
                'password' => 'password123',
                'role' => 'PEGAWAI',
            ],
            [
                'nip' => '199803272024212010',
                'nama' => 'SITI LENA MALINDA',
                'password' => 'password123',
                'role' => 'PEGAWAI',
            ],
        ];

        foreach ($pegawais as $pegawai) {
            Pegawai::updateOrCreate(
                [
                    'nip' => $pegawai['nip'],
                ],
                [
                    'nama' => $pegawai['nama'],
                    'password' => Hash::make($pegawai['password']),
                    'role' => $pegawai['role'],
                ]
            );
        }
    }
}
