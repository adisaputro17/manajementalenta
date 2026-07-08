@extends('layouts.app')

@section('content')

<h3>Edit Pegawai</h3>

<form method="POST" action="{{route('pegawai.update',$pegawai->id)}}">
    @csrf
    @method('PUT')
    @include('pegawai.form')
    
    <button class="btn btn-primary">Update</button>
</form>

@endsection