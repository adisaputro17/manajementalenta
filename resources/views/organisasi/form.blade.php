<div class="mb-3">

<label>Pegawai</label>

<select name="pegawai_id"
class="form-select">

@foreach($pegawai as $p)

<option value="{{ $p->id }}"
@if(isset($organisasi) &&
$organisasi->pegawai_id==$p->id)
selected
@endif>

{{ $p->nama }}

</option>

@endforeach

</select>

</div>



<div class="mb-3">

<label>Nama Organisasi</label>

<input type="text"
name="nama_organisasi"
class="form-control"
value="{{ old('nama_organisasi',
$organisasi->nama_organisasi ?? '') }}">

</div>



<div class="mb-3">

<label>Peran</label>

<select name="peran"
class="form-select">

<option value="pimpinan">
Pimpinan (100)
</option>

<option value="pengurus">
Pengurus (80)
</option>

<option value="anggota">
Anggota (60)
</option>

</select>

</div>



<div class="row">

<div class="col">

<label>Tahun Mulai</label>

<input type="number"
name="tahun_mulai"
class="form-control">

</div>


<div class="col">

<label>Tahun Selesai</label>

<input type="number"
name="tahun_selesai"
class="form-control">

</div>

</div>



<div class="mb-3 mt-3">

<label>Bukti Dukung</label>

<input type="file"
name="bukti"
class="form-control">

</div>