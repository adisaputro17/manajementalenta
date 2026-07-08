@extends('layouts.app')


@section('title','Tambah Hukuman Disiplin')


@section('content')


<h3>
Tambah Hukuman Disiplin
</h3>



<form action="{{route('hukuman.store')}}"
method="POST"
enctype="multipart/form-data">


@csrf


@include('hukuman.form')



<button class="btn btn-success">

Simpan

</button>


<a href="{{route('hukuman.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection