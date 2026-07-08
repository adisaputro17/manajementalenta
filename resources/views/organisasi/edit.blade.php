@extends('layouts.app')


@section('content')


<h3>
Edit Pengalaman Organisasi
</h3>


<form method="POST"
action="{{route('organisasi.update',$organisasi)}}">

@csrf

@method('PUT')


@include('organisasi.form')


<button class="btn btn-primary">

Update

</button>


</form>


@endsection