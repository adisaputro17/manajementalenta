@extends('layouts.app')

@section('content')

<div class="container">


<div class="d-flex justify-content-between mb-3">

<h3>
Riwayat Hukuman Disiplin
</h3>


<a href="{{route('hukuman.create')}}"
class="btn btn-primary">

Tambah

</a>

</div>



@if(session('success'))

<div class="alert alert-success">
{{session('success')}}
</div>

@endif



<table class="table table-bordered">


<thead class="table-dark">

<tr>

<th>No</th>
<th>Pegawai</th>
<th>Jenis</th>
<th>Tanggal</th>
<th>Status</th>
<th>Nilai</th>
<th>Bukti</th>
<th>Aksi</th>

</tr>

</thead>


<tbody>

@foreach($data as $d)

<tr>

<td>{{$loop->iteration}}</td>


<td>
{{$d->pegawai->nama}}
</td>


<td>
{{ucfirst($d->jenis_hukuman)}}
</td>


<td>
{{$d->tanggal_hukuman}}
</td>


<td>

@if($d->sedang_menjalani)

<span class="badge bg-danger">
Sedang Menjalani
</span>

@else

<span class="badge bg-success">
Selesai
</span>

@endif

</td>


<td>

<span class="badge bg-warning">
{{$d->nilai}}
</span>

</td>


<td>

@if($d->bukti)

<a href="{{Storage::url($d->bukti)}}"
target="_blank"
class="btn btn-sm btn-secondary">

Lihat

</a>

@endif

</td>



<td>

<a href="{{route('hukuman.edit',$d)}}"
class="btn btn-warning btn-sm">

Edit

</a>


<form action="{{route('hukuman.destroy',$d)}}"
method="POST"
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


</div>

@endsection