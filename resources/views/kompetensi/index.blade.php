@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Pengembangan Kompetensi</h3>
    @if(Auth::user()->role == "ADMIN")
    <a href="{{ route('kompetensi.create') }}" class="btn btn-primary">+ Tambah</a>
    @endif
</div>

<table class="table table-bordered">
<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Pegawai</th>
    <th>JP</th>
    <th>Kegiatan</th>
    <th>Tahun</th>
    <th>Bukti</th>
    
    @if(Auth::user()->role == "ADMIN")
    <th>Aksi</th>
    @endif
</tr>
</thead>

<tbody>
@foreach($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->pegawai->nama }}</td>
    <td>{{ $d->jp }}</td>
    <td>{{ $d->kegiatan }}</td>
    <td>{{ $d->tahun }}</td>
    <td>
        @if($d->bukti)
        <a class="btn btn-sm btn-secondary"
           href="{{ Storage::url($d->bukti) }}"
           target="_blank">Lihat</a>
        @endif
    </td>
    @if(Auth::user()->role == "ADMIN")
    <td>
        <a href="{{ route('kompetensi.edit',$d) }}" class="btn btn-warning btn-sm">Edit</a>

        <form method="POST" action="{{ route('kompetensi.destroy',$d) }}" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
        </form>
    </td>
    @endif
</tr>
@endforeach
</tbody>
</table>

@endsection