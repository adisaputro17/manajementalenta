@extends('layouts.app')

@section('content')

<div class="container">


<div class="d-flex justify-content-between mb-3">

<h3>
Pengalaman Organisasi Pegawai
</h3>


<a href="{{ route('organisasi.create') }}"
class="btn btn-primary">

Tambah

</a>

</div>



@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif



<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Pegawai</th>
<th>Organisasi</th>
<th>Jenis</th>
<th>Peran</th>
<th>Nilai</th>
<th>Bukti</th>
<th>Aksi</th>

</tr>

</thead>


<tbody>

@foreach($data as $d)

<tr>

<td>
{{ $loop->iteration }}
</td>


<td>
{{ $d->pegawai->nama }}
</td>


<td>
{{ $d->nama_organisasi }}
</td>


<td>
{{ ucfirst($d->jenis_organisasi) }}
</td>


<td>
{{ ucfirst($d->peran) }}
</td>


<td>
<span class="badge bg-success">
{{ $d->nilai }}
</span>
</td>


<td>

@if($d->bukti)

<a href="{{ Storage::url($d->bukti) }}"
target="_blank"
class="btn btn-sm btn-secondary">

Lihat

</a>

@endif

</td>



<td>

<a href="{{ route('organisasi.edit',$d) }}"
class="btn btn-warning btn-sm">

Edit

</a>


<form action="{{route('organisasi.destroy',$d)}}"
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


{{ $data->links() }}


</div>

@endsection