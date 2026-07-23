<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Services\TalentScoreService;
use App\Services\TalentIndicatorService;
use Illuminate\Support\Facades\Auth;
use App\Exports\TalentMatrixExport;
use Maatwebsite\Excel\Facades\Excel;

class TalentMatrixController extends Controller
{
    public function index(TalentScoreService $score, TalentIndicatorService $indicator)
    {
        $matrix = $this->buildMatrix($score, $indicator);
        
        return view('talent.matrix', compact('matrix'));
    }
    
    public function export($box, TalentScoreService $score, TalentIndicatorService $indicator)
    {
        $matrix = $this->buildMatrix($score, $indicator);
        
        if (!isset($matrix[$box])) {
            abort(404);
        }
        
        return Excel::download(
            new TalentMatrixExport($matrix[$box], $box),
            "Talent-{$box}.xlsx"
        );
    }

    private function buildMatrix(TalentScoreService $score, TalentIndicatorService $indicator)
    {
        if (Auth::user()->role == 'ADMIN') {
            $pegawais = Pegawai::all();
        } else {
            $pegawais = Pegawai::where('id', Auth::id())->get();
        }

        $pegawai = $pegawais->map(function ($pegawai) use ($score, $indicator) {
            $result = $score->calculate($pegawai->id, $indicator);

            return [
                'nama'        => $pegawai->nama,
                'performance' => $result['performance'],
                'potential'   => $result['potential'],
                'box'         => $result['box']['key'],
                'label'       => $result['box']['label'],
            ];
        });

        $matrix = [
            'high-high'      => [],
            'high-medium'    => [],
            'high-low'       => [],
            'medium-high'    => [],
            'medium-medium'  => [],
            'medium-low'     => [],
            'low-high'       => [],
            'low-medium'     => [],
            'low-low'        => [],
        ];

        foreach ($pegawai as $item) {
            $matrix[$item['box']][] = $item;
        }

        return $matrix;
    }
}