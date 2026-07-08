<div class="mb-3">

<label>Pegawai</label>

<select name="pegawai_id"
class="form-select">

@foreach($pegawai as $p)

<option value="{{$p->id}}">

{{$p->nama}}

</option>

@endforeach

</select>

</div>



<div class="mb-3">

<label>Jenis Hukuman</label>

<select name="jenis_hukuman"
class="form-select">

<option value="ringan">
Ringan (70)
</option>

<option value="sedang">
Sedang (40)
</option>

<option value="berat">
Berat (10)
</option>

</select>

</div>



<div class="mb-3">

<label>Tanggal Mulai</label>

<input type="date"
name="tanggal_mulai"
class="form-control">

</div>



<div class="mb-3">

<label>Tanggal Selesai</label>

<input type="date"
name="tanggal_selesai"
class="form-control">

</div>



<div class="mb-3">

<label>Status</label>

<select name="sedang_menjalani"
class="form-select">

<option value="0">
Tidak Menjalani
</option>

<option value="1">
Sedang Menjalani
</option>

</select>

</div>



<div class="mb-3">

<label>Nomor SK</label>

<input type="text"
name="nomor_sk"
class="form-control">

</div>



<div class="mb-3">

<label>Bukti SK</label>

<input type="file"
name="bukti"
class="form-control">

</div>