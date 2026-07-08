@extends('layouts.app')


@section('content')


<h3>
Edit Pendidikan Formal
</h3>


<form action="{{route('pendidikan.update',$pendidikan)}}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')


@include('pendidikan.form')


<button class="btn btn-primary">

Update

</button>


</form>


@endsection