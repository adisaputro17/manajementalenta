<div class="mb-3">

<label>Pegawai</label>

<select name="pegawai_id"
class="form-select">

@foreach($pegawai as $p)

<option value="{{ $p->id }}"
@if(isset($riwayatJabatan) &&
$riwayatJabatan->pegawai_id==$p->id)
selected
@endif>

{{ $p->nama }}

</option>

@endforeach

</select>

</div>


<div class="mb-3">

<label>Nama Jabatan</label>

<input type="text"
name="nama_jabatan"
class="form-control"
value="{{ old('nama_jabatan',$riwayatJabatan->nama_jabatan ?? '') }}">

</div>


<div class="mb-3">

<label>Jenis Jabatan</label>

<select name="jenis_jabatan"
class="form-select">

<option value="struktural">
Struktural
</option>

<option value="fungsional">
Fungsional
</option>

</select>

</div>


<div class="row">

<div class="col">

<label>Mulai</label>

<input type="date"
name="mulai_jabatan"
class="form-control"
value="{{ old('mulai_jabatan',$riwayatJabatan->mulai_jabatan ?? '') }}">

</div>


<div class="col">

<label>Akhir</label>

<input type="date"
name="akhir_jabatan"
class="form-control"
value="{{ old('akhir_jabatan',$riwayatJabatan->akhir_jabatan ?? '') }}">

</div>

</div>


<div class="mb-3 mt-3">

<label>Bukti</label>

<input type="file"
name="bukti"
class="form-control">

</div>