@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Pendidikan Formal Pegawai</h3>
    
    @if(Auth::user()->role == "ADMIN")
    <a href="{{route('pendidikan.create')}}" class="btn btn-primary">
        Tambah
    </a>
    @endif
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Pegawai</th>
            <th>Tingkat</th>
            <th>Jurusan</th>
            <th>Sekolah/Universitas</th>
            <th>Bukti</th>
            
            @if(Auth::user()->role == "ADMIN")
            <th>Aksi</th>
            @endif
        </tr>
    </thead>
<tbody>

@forelse($data as $d)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$d->pegawai->nama}}</td>
        <td>
            <span class="badge bg-primary">{{$d->tingkatan}}</span>
        </td>
        <td>{{$d->jurusan}}</td>
        <td>{{$d->universitas_sekolah}}</td>
        @if(Auth::user()->role == "ADMIN")
        <td>
            @if($d->bukti)
            <a href="{{asset('storage/'.$d->bukti)}}" target="_blank" class="btn btn-secondary btn-sm">
                Lihat
            </a>
            @endif
        </td>
        <td>
            <a href="{{route('pendidikan.edit',$d)}}" class="btn btn-warning btn-sm">
                Edit
            </a>
            
            <form method="POST" action="{{route('pendidikan.destroy',$d)}}" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                    Hapus
                </button>
            </form>
        </td>
        @endif
    </tr>
@empty

<tr>
    <td colspan="7" class="text-center">
        Tidak ada data.
    </td>
</tr>

@endforelse

</tbody>

</table>

{{ $data->links() }}

@endsection