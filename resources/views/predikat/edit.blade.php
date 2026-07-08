@extends('layouts.app')

@section('content')

<h3>Edit Predikat Kinerja</h3>

<form method="POST" action="{{route('predikat.update',$predikat)}}">
    @csrf
    @method('PUT')
    @include('predikat.form')
    
    <button class="btn btn-primary">Update</button>
</form>

@endsection