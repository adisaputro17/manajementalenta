<?php

namespace App\Services;

use App\Models\TalentWeight;


class TalentScoreService
{
    public function calculate($pegawaiId, TalentIndicatorService $indicator)
    {
        $data = $indicator->get($pegawaiId);
        $weights = TalentWeight::pluck('persentase', 'indikator');
        
        $performance=0;
        $potential=0;
        
        foreach($data as &$item){
            $bobot = $weights[$item['nama']] ?? 0;
            $item['bobot']=$bobot;
            $item['kontribusi'] = $item['nilai'] * $bobot / 100;
            
            if($item['kategori']=='kinerja') {
                $performance += $item['kontribusi'];
            } else {
                $potential += $item['kontribusi'];
            }
        }
        
        return [
            'detail'=>$data,
            'performance'=>$performance,
            'potential'=>$potential,
            'box'=>$this->box(
                $performance,
                $potential
            )
        ];
    }
    
    private function box($performance,$potential)
    {
        $y = match(true){
            $performance >= 80 => 'high',
            $performance >= 60 => 'medium',
            default => 'low'
        };
        
        $x = match(true){
            $potential >= 80 => 'high',
            $potential >= 60 => 'medium',
            default => 'low'
        };
        
        return [
            'key'=>$x.'-'.$y,
            'label'=>strtoupper($y) .' PERFORMANCE - '. strtoupper($x) .' POTENTIAL'
        ];
    }
}