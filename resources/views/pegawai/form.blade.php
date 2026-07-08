<div class="mb-3">
    <label>NIP</label>
    <input class="form-control" name="nip" value="{{old('nip',$pegawai->nip ?? '')}}">
</div>

<div class="mb-3">
    <label>Nama</label>
    <input class="form-control"name="nama" value="{{old('nama',$pegawai->nama ?? '')}}">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        @if(isset($pegawai))
            <small class="text-muted">
                Kosongkan jika password tidak ingin diubah.
            </small>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label>Role</label>
        <select name="role" class="form-select">
            <option value="PEGAWAI"
                {{ old('role', $pegawai->role ?? '') == 'PEGAWAI' ? 'selected' : '' }}>
                Pegawai
            </option>

            <option value="ADMIN"
                {{ old('role', $pegawai->role ?? '') == 'ADMIN' ? 'selected' : '' }}>
                Administrator
            </option>
        </select>
    </div>

</div>


<div class="mb-3">
    <label>Jabatan</label>
    <input class="form-control" name="jabatan" value="{{old('jabatan',$pegawai->jabatan ?? '')}}">
</div>

<div class="mb-3">
    <label>Unit Kerja</label>
    <input class="form-control" name="unit_kerja" value="{{old('unit_kerja',$pegawai->unit_kerja ?? '')}}">
</div>

<div class="mb-3">
    <label>Golongan</label>
    <input class="form-control" name="golongan" value="{{old('golongan',$pegawai->golongan ?? '')}}">
</div>