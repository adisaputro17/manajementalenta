<div class="mb-3">

<label>
Pegawai
</label>


<select name="pegawai_id"
class="form-select">


@foreach($pegawai as $p)


<option value="{{$p->id}}"

@if(isset($pendidikan)
&&
$pendidikan->pegawai_id==$p->id)

selected

@endif

>

{{$p->nama}}

</option>


@endforeach


</select>


</div>




<div class="mb-3">

<label>
Tingkat Pendidikan
</label>


<select name="tingkatan"
class="form-select">


@foreach([
'S3'=>100,
'S2'=>90,
'S1'=>80,
'D3'=>70,
'SMA'=>60
] as $key=>$nilai)


<option value="{{$key}}"

@if(isset($pendidikan)
&&
$pendidikan->tingkatan==$key)

selected

@endif

>

{{$key}} ({{$nilai}})

</option>


@endforeach


</select>


</div>





<div class="mb-3">

<label>
Jurusan
</label>


<input type="text"
name="jurusan"
class="form-control"

value="{{old('jurusan',$pendidikan->jurusan ?? '')}}">


</div>





<div class="mb-3">

<label>
Universitas/Sekolah
</label>


<input type="text"
name="universitas_sekolah"
class="form-control"

value="{{old('universitas_sekolah',$pendidikan->universitas_sekolah ?? '')}}">


</div>





<div class="mb-3">

<label>
Tahun Lulus
</label>


<input type="number"
name="tahun_lulus"
class="form-control"

value="{{old('tahun_lulus',$pendidikan->tahun_lulus ?? '')}}">


</div>





<div class="mb-3">

<label>
Bukti Dukung
</label>


<input type="file"
name="bukti"
class="form-control">


@if(isset($pendidikan) && $pendidikan->bukti)

<a href="{{asset('storage/'.$pendidikan->bukti)}}"
target="_blank">

Lihat Bukti Lama

</a>

@endif


</div>