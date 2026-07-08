@extends('layouts.app')

@section('content')

<h3>Edit Penugasan Tim/Pokja</h3>

<form action="{{ route('penugasan.update',$penugasan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('penugasan.form')

    <button class="btn btn-primary">Update</button>
</form>

@endsection