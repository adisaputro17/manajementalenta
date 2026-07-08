@extends('layouts.app')

@section('content')

<h3>Tambah Penghargaan</h3>

<form action="{{route('penghargaan.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('penghargaan.form')
    <button class="btn btn-success">Simpan</button>
    
    <a href="{{route('penghargaan.index')}}" class="btn btn-secondary">Kembali</a>
</form>

@endsection