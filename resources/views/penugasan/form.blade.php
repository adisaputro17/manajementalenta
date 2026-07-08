<div class="mb-3">
    <label>Pegawai</label>
    <select name="pegawai_id" class="form-control">
        @foreach($pegawai as $p)
        <option value="{{$p->id}}" @if(isset($penugasan) && $penugasan->pegawai_id==$p->id) selected @endif >
            {{$p->nama}}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Lingkup Penugasan</label>
    <select name="lingkup" id="lingkup" class="form-control">
        <option value="eksternal" {{ old('lingkup', $penugasan->lingkup ?? '') == 'eksternal' ? 'selected' : '' }}>Eksternal Instansi</option>
        <option value="internal" {{ old('lingkup', $penugasan->lingkup ?? '') == 'internal' ? 'selected' : '' }}>Internal Instansi</option>
    </select>
</div>

<div class="mb-3">
    <label>Tingkatan</label>
    <select name="tingkatan" id="tingkatan" class="form-control">
    </select>
</div>

<div class="mb-3">
    <label>Nama Tim/Pokja</label>
    <input class="form-control" name="nama_tim" value="{{old('nama_tim', $penugasan->nama_tim ?? '')}}">
</div>

<div class="mb-3">
    <label>Tahun</label>
    <input class="form-control" type="number" name="tahun" value="{{old('tahun', $penugasan->tahun ?? date('Y'))}}">
</div>

<div class="mb-3">
    <label>Bukti Dukung</label>
    <input type="file" class="form-control" name="bukti">
</div>

<script>

let data={
    eksternal:[
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja antarinstansi',
        'Koordinator/Subkoordinator pada tim/pokja antarinstansi',
        'Anggota pada tim/pokja antarinstansi'
    ],
    
    internal:[
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja antarunit kerja',
        'Koordinator/Subkoordinator pada tim/pokja antarunit kerja',
        'Anggota pada tim/pokja antarunit kerja',
        'Pengarah/Penanggung Jawab/Ketua pada tim/pokja unit kerja',
        'Koordinator/Subkoordinator pada tim/pokja unit kerja',
        'Anggota pada tim/pokja unit kerja'
    ],
};

function loadTingkatan(){
    let lingkup = document.getElementById('lingkup').value;
    let tingkat = document.getElementById('tingkatan');
    
    tingkat.innerHTML='';

    let selected = @json(old('tingkatan', $penugasan->tingkatan ?? ''));
    
    data[lingkup].forEach(x=>{
        let option = document.createElement('option');
        option.value=x;
        option.text=x;

        if(x==selected){
            option.selected=true;
        }
        
        tingkat.appendChild(option);
    });
}

document.getElementById('lingkup').addEventListener('change', loadTingkatan);

loadTingkatan();

</script>