<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanTim extends Model
{
    protected $fillable=[
        'pegawai_id',
        'lingkup',
        'tingkatan',
        'nilai',
        'nama_tim',
        'tahun',
        'bukti',
        'row_status',
        'approved_by',
        'approved_at',
        'reject_reason'
    ];
    
    public const LEVEL = [
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja antarinstansi'=>100,
        'Koordinator/Subkoordinator pada tim/pokja antarinstansi'=>90,
        'Anggota pada tim/pokja antarinstansi'=>80,
        
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja antarunit kerja'=>70,
        'Koordinator/Subkoordinator pada tim/pokja antarunit kerja'=>60,
        'Anggota pada tim/pokja antarunit kerja'=>50,
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja unit kerja'=>40,
        'Koordinator/Subkoordinator pada tim/pokja unit kerja'=>30,
        'Anggota pada tim/pokja unit kerja'=>20,
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
