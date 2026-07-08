@extends('layouts.app')


@section('title','Riwayat Jabatan')


@section('content')


<h3>
Riwayat Jabatan
</h3>



<form action="{{route('riwayat-jabatan.store')}}"
method="POST"
enctype="multipart/form-data">


@csrf


@include('riwayat_jabatan.form')



<button class="btn btn-success">

Simpan

</button>


<a href="{{route('riwayat-jabatan.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection