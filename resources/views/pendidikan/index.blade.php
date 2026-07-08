@extends('layouts.app')


@section('title','Pendidikan Formal')


@section('content')


<div class="d-flex justify-content-between mb-3">

<h3>
Pendidikan Formal Pegawai
</h3>


<a href="{{route('pendidikan.create')}}"
class="btn btn-primary">

+ Tambah

</a>


</div>




<table class="table table-bordered table-striped">


<thead class="table-dark">

<tr>

<th>No</th>
<th>Pegawai</th>
<th>Tingkat</th>
<th>Nilai</th>
<th>Jurusan</th>
<th>Sekolah/Universitas</th>
<th>Bukti</th>
<th>Aksi</th>

</tr>

</thead>


<tbody>


@foreach($data as $d)


<tr>


<td>
{{$loop->iteration}}
</td>


<td>
{{$d->pegawai->nama}}
</td>


<td>

<span class="badge bg-primary">

{{$d->tingkatan}}

</span>

</td>


<td>
{{$d->nilai}}
</td>


<td>
{{$d->jurusan}}
</td>


<td>
{{$d->universitas_sekolah}}
</td>


<td>

@if($d->bukti)

<a href="{{asset('storage/'.$d->bukti)}}"
target="_blank"
class="btn btn-secondary btn-sm">

Lihat

</a>

@endif

</td>


<td>


<a href="{{route('pendidikan.edit',$d)}}"
class="btn btn-warning btn-sm">

Edit

</a>



<form method="POST"
action="{{route('pendidikan.destroy',$d)}}"
class="d-inline">


@csrf

@method('DELETE')


<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</button>


</form>


</td>


</tr>


@endforeach


</tbody>


</table>


{{$data->links()}}


@endsection