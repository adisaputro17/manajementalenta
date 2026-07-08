@extends('layouts.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between mb-3">

<h3>
Riwayat Jabatan
</h3>


<a href="{{ route('riwayat-jabatan.create') }}"
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
<th>Jabatan</th>
<th>Jenis</th>
<th>Mulai</th>
<th>Selesai</th>
<th>Bukti</th>
<th>Aksi</th>

</tr>

</thead>


<tbody>

@foreach($data as $d)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ $d->pegawai->nama }}
</td>


<td>
{{ $d->nama_jabatan }}
</td>


<td>
{{ ucfirst($d->jenis_jabatan) }}
</td>


<td>
{{ $d->mulai_jabatan }}
</td>


<td>
{{ $d->akhir_jabatan ?? '-' }}
</td>


<td>

@if($d->bukti)

<a target="_blank"
href="{{ Storage::url($d->bukti) }}"
class="btn btn-sm btn-secondary">

Lihat

</a>

@endif

</td>


<td>

<a href="{{ route('riwayat-jabatan.edit',$d) }}"
class="btn btn-warning btn-sm">

Edit

</a>


<form action="{{ route('riwayat-jabatan.destroy',$d) }}"
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