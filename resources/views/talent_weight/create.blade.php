@extends('layouts.app')


@section('content')


<h3>
Tambah Indikator Kinerja
</h3>


<form method="POST"
action="{{route('talent-weight.store')}}">

@csrf


@include('talent_weight.form')


<button class="btn btn-success">

Simpan

</button>


</form>


@endsection