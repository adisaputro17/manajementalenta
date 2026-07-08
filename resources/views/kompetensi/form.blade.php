<div class="mb-3">
    <label>Pegawai</label>
    <select name="pegawai_id" class="form-select">
        @foreach($pegawai as $p)
        <option value="{{ $p->id }}"
            @if(isset($kompetensi) && $kompetensi->pegawai_id==$p->id) selected @endif>
            {{ $p->nama }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>JP (Jam Pelajaran)</label>
    <input type="number" name="jp" class="form-control"
           value="{{ $kompetensi->jp ?? old('jp') }}">
</div>

<div class="mb-3">
    <label>Kegiatan</label>
    <input type="text" name="kegiatan" class="form-control"
           value="{{ $kompetensi->kegiatan ?? old('kegiatan') }}">
</div>

<div class="mb-3">
    <label>Penyelenggara</label>
    <input type="text" name="penyelenggara" class="form-control"
           value="{{ $kompetensi->penyelenggara ?? old('penyelenggara') }}">
</div>

<div class="mb-3">
    <label>Tahun</label>
    <input type="number" name="tahun" class="form-control"
           value="{{ $kompetensi->tahun ?? date('Y') }}">
</div>

<div class="mb-3">
    <label>Bukti Dukung</label>
    <input type="file" name="bukti" class="form-control">
</div>