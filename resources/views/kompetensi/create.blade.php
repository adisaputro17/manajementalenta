@extends('layouts.app')


@section('title','Tambah Pengembangan Kompetensi')


@section('content')


<h3>
Tambah Pengembangan Kompetensi
</h3>



<form action="{{route('kompetensi.store')}}"
method="POST"
enctype="multipart/form-data">


@csrf


@include('kompetensi.form')



<button class="btn btn-success">

Simpan

</button>


<a href="{{route('kompetensi.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection