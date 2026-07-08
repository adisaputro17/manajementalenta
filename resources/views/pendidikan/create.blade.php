@extends('layouts.app')


@section('content')


<h3>
Tambah Pendidikan Formal
</h3>


<form action="{{route('pendidikan.store')}}"
method="POST"
enctype="multipart/form-data">


@csrf


@include('pendidikan.form')


<button class="btn btn-success">
Simpan
</button>


</form>


@endsection