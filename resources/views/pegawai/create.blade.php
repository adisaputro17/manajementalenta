@extends('layouts.app')

@section('content')

<h3>Tambah Pegawai</h3>

<form method="POST" action="{{route('pegawai.store')}}">
    @csrf
    @include('pegawai.form')
    <button class="btn btn-success">Simpan</button>
    
    <a href="{{route('pegawai.index')}}" class="btn btn-secondary">Kembali</a>
</form>

@endsection