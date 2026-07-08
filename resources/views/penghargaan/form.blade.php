<div class="mb-3">
    <label>Pegawai</label>
    <select name="pegawai_id" class="form-control">
        @foreach($pegawai as $p)
        <option value="{{$p->id}}" @if(isset($penghargaan) && $penghargaan->pegawai_id==$p->id) selected @endif >
            {{$p->nama}}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jenis Penghargaan</label>
    <select name="jenis" id="jenis" class="form-control">
        <option value="eksternal" {{ old('jenis', $penghargaan->jenis ?? '') == 'eksternal' ? 'selected' : '' }}>Eksternal Instansi</option>
        <option value="internal" {{ old('jenis', $penghargaan->jenis ?? '') == 'internal' ? 'selected' : '' }}>Internal Instansi</option>
    </select>
</div>

<div class="mb-3">
    <label>Tingkatan</label>
    <select name="tingkatan" id="tingkatan" class="form-control">
    </select>
</div>

<div class="mb-3">
    <label>Nama Penghargaan</label>
    <input class="form-control" name="nama_penghargaan" value="{{old('nama_penghargaan', $penghargaan->nama_penghargaan ?? '')}}">
</div>

<div class="mb-3">
    <label>Pemberi Penghargaan</label>
    <input class="form-control" name="pemberi" value="{{old('pemberi', $penghargaan->pemberi ?? '')}}">
</div>

<div class="mb-3">
    <label>Tahun</label>
    <input type="number" class="form-control" name="tahun" value="{{old('tahun', $penghargaan->tahun ?? date('Y'))}}">
</div>

<div class="mb-3">
    <label>Bukti Dukung</label>
    <input type="file" class="form-control" name="bukti">
</div>


<script>

function loadTingkat(){
    let jenis = document.getElementById('jenis').value;
    let tingkat = document.getElementById('tingkatan');
    
    tingkat.innerHTML='';
    
    let data={
        eksternal:[
            'Internasional',
            'Nasional',
            'Regional'
        ],
        
        internal:[
            'Instansi',
            'Unit Kerja',
        ],
    };

    let selected = @json(old('tingkatan', $penghargaan->tingkatan ?? ''));

    data[jenis].forEach(function(item){
        let option=document.createElement('option');
        option.value=item;
        option.text=item;

        if (item === selected) {
            option.selected = true;
        }

        tingkat.appendChild(option);
    });
}

document.getElementById('jenis').addEventListener('change', loadTingkat);

loadTingkat();

</script>