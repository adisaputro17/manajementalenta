@extends('layouts.app')


@section('title','Edit Pengembangan Kompetensi')


@section('content')


<h3>
Edit Pengembangan Kompetensi
</h3>



<form action="{{route('kompetensi.update',$kompetensi)}}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')


@include('kompetensi.form')



<button class="btn btn-primary">

Update

</button>


<a href="{{route('kompetensi.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection