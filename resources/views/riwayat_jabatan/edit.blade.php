@extends('layouts.app')


@section('title','Edit Riwayat Jabatan')


@section('content')


<h3>
Edit Riwayat Jabatan
</h3>



<form action="{{route('riwayat-jabatan.update',$riwayatJabatan)}}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')


@include('riwayat_jabatan.form')



<button class="btn btn-primary">

Update

</button>


<a href="{{route('riwayat-jabatan.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection