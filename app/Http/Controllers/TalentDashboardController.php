<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Services\TalentScoreService;
use App\Services\TalentIndicatorService;

class TalentDashboardController extends Controller
{
    public function index(TalentScoreService $score, TalentIndicatorService $indicator)
    {
        $data = Pegawai::get()->map(function($pegawai)use($score,$indicator){
            $result = $score->calculate($pegawai->id, $indicator);
            
            return [
                'nama'=>$pegawai->nama,
                'detail'=>$result['detail'],
                'performance'=>$result['performance'],
                'potential'=>$result['potential'],
                'box'=>$result['box']
            ];
        });
        
        return view('talent.dashboard', compact('data'));
    }

}