<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TalentMatrixExport implements FromCollection, WithHeadings
{
    protected $pegawai;
    protected $box;

    public function __construct(array $pegawai, string $box)
    {
        $this->pegawai = $pegawai;
        $this->box = $box;
    }

    public function headings(): array
    {
        return [
            'Nama Pegawai',
            'Performance',
            'Potential',
        ];
    }

    public function collection()
    {
        $rows = [];

        foreach ($this->pegawai as $item) {
            $rows[] = [
                $item['nama'],
                $item['performance'],
                $item['potential'],
            ];
        }

        return new Collection($rows);
    }
}