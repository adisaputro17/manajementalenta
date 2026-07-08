<div class="mb-3">
    <label>Pegawai</label>
    <select name="pegawai_id" class="form-control">
        @foreach($pegawai as $p)
        <option value="{{$p->id}}" @if(isset($predikat) && $predikat->pegawai_id==$p->id) selected @endif >
            {{$p->nama}}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tahun</label>
    <input type="number" name="tahun" class="form-control" value="{{old('tahun',$predikat->tahun ?? date('Y'))}}">
</div>

@php
$pilihan = [
    100 => 'Sangat Baik',
    80  => 'Baik',
    60  => 'Butuh Perbaikan',
    40  => 'Kurang',
    20  => 'Sangat Kurang',
];
@endphp

<div class="mb-3">
    <label>Nilai</label>
    <select name="nilai" class="form-control">
        @foreach($pilihan as $value => $label)
        <option value="{{ $value }}" {{ old('nilai', $predikat->nilai ?? '') == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
        @endforeach
    </select>
</div>