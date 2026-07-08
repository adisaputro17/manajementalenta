@extends('layouts.app')


@section('title','Edit Hukuman Disiplin')


@section('content')


<h3>
Edit Hukuman Disiplin
</h3>



<form action="{{route('hukuman.update',$hukuman)}}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')


@include('hukuman.form')



<button class="btn btn-primary">

Update

</button>


<a href="{{route('hukuman.index')}}"
class="btn btn-secondary">

Kembali

</a>


</form>


@endsection