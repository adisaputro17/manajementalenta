@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h3>
        Talent Management Dashboard
    </h3>
    
    @foreach($data as $pegawai)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5>{{ $pegawai['nama'] }}</h5>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Indikator</th>
                        <th>Kategori</th>
                        <th>Nilai</th>
                        <th>Bobot</th>
                        <th>Kontribusi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawai['detail'] as $d)
                    <tr>
                        <td>{{$d['nama']}}</td>
                        <td>{{$d['kategori']}}</td>
                        <td>{{$d['nilai']}}</td>
                        <td>{{$d['bobot']}} %</td>
                        <td>{{number_format($d['kontribusi'],2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-info">
                        Performance
                        <br>
                        <h4>{{number_format($pegawai['performance'],2)}}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success">
                        Potential<br>
                        <h4>{{number_format($pegawai['potential'],2)}}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        BOX
                        <h5>{{$pegawai['box']['label']}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection