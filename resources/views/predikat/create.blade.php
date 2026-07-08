@extends('layouts.app')

@section('content')

<h3>Tambah Predikat Kinerja</h3>

<form method="POST" action="{{route('predikat.store')}}">
    @csrf
    @include('predikat.form')
    <button class="btn btn-success">Simpan</button>
    
    <a href="{{route('predikat.index')}}" class="btn btn-secondary">Kembali</a>
</form>

@endsection