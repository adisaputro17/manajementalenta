@extends('layouts.app')


@section('content')


<h3>
Tambah Pengalaman Organisasi
</h3>


<form method="POST"
action="{{route('organisasi.store')}}">

@csrf


@include('organisasi.form')


<button class="btn btn-success">

Simpan

</button>


</form>


@endsection