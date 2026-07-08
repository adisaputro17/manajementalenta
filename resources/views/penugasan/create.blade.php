@extends('layouts.app')

@section('content')

<h3>Tambah Penugasan Tim/Pokja</h3>

<form action="{{ route('penugasan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('penugasan.form')
    <button class="btn btn-success">Simpan</button>
    
    <a href="{{ route('penugasan.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection