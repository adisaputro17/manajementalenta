@extends('layouts.app')


@section('content')

<div class="container">


<div class="d-flex justify-content-between">

<h3>
Setting Bobot Talent Matrix
</h3>


<a href="{{route('talent-weight.create')}}"
class="btn btn-primary">

Tambah

</a>


</div>


@if(session('success'))

<div class="alert alert-success mt-3">

{{session('success')}}

</div>

@endif



<table class="table table-bordered mt-3">


<thead class="table-dark">

<tr>

<th>No</th>

<th>Sumbu</th>

<th>Indikator</th>

<th>Persentase</th>

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

@if($d->kategori=='kinerja')

<span class="badge bg-primary">
Sumbu Y - Kinerja
</span>

@else

<span class="badge bg-success">
Sumbu X - Potensial
</span>

@endif

</td>


<td>
{{$d->indikator}}
</td>


<td>
{{$d->persentase}} %
</td>


<td>

<a href="{{route('talent-weight.edit',$d)}}"
class="btn btn-warning btn-sm">

Edit

</a>


<form
action="{{route('talent-weight.destroy',$d)}}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

Hapus

</button>

</form>


</td>


</tr>


@endforeach


</tbody>

</table>


</div>

@endsection