@extends('layouts.app')


@section('content')


<h3>
Edit Indikator Kinerja
</h3>


<form method="POST"
action="{{route('talent-weight.update',$talentWeight)}}">

@csrf

@method('PUT')


@include('talent_weight.form')


<button class="btn btn-primary">

Update

</button>


</form>


@endsection