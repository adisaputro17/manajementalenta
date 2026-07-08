@extends('layouts.app')

@section('content')

<h3>Edit Penghargaan</h3>

<form action="{{route('penghargaan.update',$penghargaan)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('penghargaan.form')

    <button class="btn btn-primary">Update</button>
</form>

@endsection