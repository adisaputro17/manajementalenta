<div class="mb-3">

<label>Kategori</label>

<select name="kategori"
class="form-select">


<option value="kinerja">
Kinerja (Sumbu Y)
</option>


<option value="potensial">
Potensial (Sumbu X)
</option>


</select>

</div>



<div class="mb-3">

<label>Indikator</label>

<input type="text"
name="indikator"
class="form-control"
value="{{old('indikator',
$talentWeight->indikator ?? '')}}">

</div>



<div class="mb-3">

<label>Persentase</label>

<input type="number"
step="0.01"
name="persentase"
class="form-control"
value="{{old('persentase',
$talentWeight->persentase ?? '')}}">

</div>