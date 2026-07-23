@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h3 class="mb-4">
        Talent 9 Box Matrix
    </h3>
    
    <div class="row">
        @php
        $boxes = [
            'high-low' => [
                'no' => 4,
                'title' => 'Kinerja Tinggi - Potensi Rendah',
                'description' => 'Pegawai berkinerja tinggi yang diharapkan tetap mempertahankan kinerjanya dan diberikan pengembangan sesuai kebutuhan organisasi.',
                'color' => 'warning',
            ],

            'high-medium' => [
                'no' => 7,
                'title' => 'Kinerja Tinggi - Potensi Sedang',
                'description' => 'Pegawai dengan kinerja tinggi dan potensi sedang yang layak dikembangkan untuk meningkatkan kapasitas kepemimpinan maupun kompetensi.',
                'color' => 'success-subtle',
            ],

            'high-high' => [
                'no' => 9,
                'title' => 'Kinerja Tinggi - Potensi Tinggi',
                'description' => 'Pegawai dengan kinerja dan potensi tinggi yang diprioritaskan untuk pengembangan dan dipersiapkan dalam rencana suksesi jabatan.',
                'color' => 'success',
            ],

            'medium-low' => [
                'no' => 2,
                'title' => 'Kinerja Sedang - Potensi Rendah',
                'description' => 'Pegawai dengan kinerja cukup namun potensi terbatas, memerlukan pembinaan sesuai kebutuhan jabatan.',
                'color' => 'danger-subtle',
            ],

            'medium-medium' => [
                'no' => 5,
                'title' => 'Kinerja Sedang - Potensi Sedang',
                'description' => 'Pegawai dengan kinerja dan potensi yang cukup baik serta perlu pengembangan berkelanjutan.',
                'color' => 'warning',
            ],

            'medium-high' => [
                'no' => 8,
                'title' => 'Kinerja Sedang - Potensi Tinggi',
                'description' => 'Pegawai dengan potensi tinggi yang memerlukan pembinaan dan kesempatan untuk meningkatkan kinerja.',
                'color' => 'success-subtle',
            ],

            'low-low' => [
                'no' => 1,
                'title' => 'Kinerja Rendah - Potensi Rendah',
                'description' => 'Pegawai yang memerlukan perhatian khusus melalui evaluasi dan pembinaan sesuai ketentuan organisasi.',
                'color' => 'danger',
            ],

            'low-medium' => [
                'no' => 3,
                'title' => 'Kinerja Rendah - Potensi Sedang',
                'description' => 'Pegawai yang memerlukan peningkatan kinerja melalui pengembangan kompetensi dan pembinaan.',
                'color' => 'danger-subtle',
            ],

            'low-high' => [
                'no' => 6,
                'title' => 'Kinerja Rendah - Potensi Tinggi',
                'description' => 'Pegawai dengan potensi tinggi namun kinerja belum optimal sehingga memerlukan evaluasi dan pembinaan.',
                'color' => 'warning',
            ],
        ];
        @endphp
        
        @foreach($boxes as $key => $box)
        <div class="col-md-4">
            <div class="card mb-3 border-{{ $box['color'] }}">
                <div class="card-header text-center bg-{{ $box['color'] }}">
                    <h5>Box {{ $box['no'] }}</h5>
                    <strong>{{ $box['title'] }}</strong>
                    <br>
                    <a href="{{ route('talent.matrix.export', $key) }}"
                        class="btn btn-sm btn-success mt-2">
                        <i class="fas fa-file-excel"></i> Export
                    </a>
                    <br>
                    <small class="text-muted">
                        {{ $box['description'] }}
                    </small>
                </div>
                
                <div class="card-body" style="min-height:180px;">
                    @forelse($matrix[$key] ?? [] as $pegawai)
                    <div class="border rounded p-2 mb-2">
                        <b>{{ $pegawai['nama'] }}</b>
                        <br>
                        <small>
                            Performance : {{ number_format($pegawai['performance'], 2) }}
                            <br>
                            Potential : {{ number_format($pegawai['potential'], 2) }}
                        </small>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        Tidak ada pegawai
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection