@extends('layouts.app')

@section('title','Data Pegawai')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Pegawai</h3>
    
    <a href="{{route('pegawai.create')}}" class="btn btn-primary">
        Tambah Pegawai
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Jabatan</th>
            <th>Unit Kerja</th>
            <th>Golongan</th>
            <th>Aksi</th>
        </tr>
    </thead>
<tbody>


@foreach($pegawais as $p)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$p->nip}}</td>
    <td>{{$p->nama}}</td>
    <td>{{$p->role}}</td>
    <td>{{$p->jabatan}}</td>
    <td>{{$p->unit_kerja}}</td>
    <td>{{$p->golongan}}</td>
    <td>
        <a href="{{route('pegawai.edit',$p->id)}}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{route('pegawai.destroy',$p->id)}}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach


</tbody>

</table>

@endsection