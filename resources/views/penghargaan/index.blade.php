@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Penghargaan</h3>
    
    <a href="{{ route('penghargaan.create') }}" class="btn btn-primary">
        Tambah
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Pegawai</th>
            <th>Jenis</th>
            <th>Tingkatan</th>
            <th>Nama Penghargaan</th>
            <th>Pemberi</th>
            <th>Tahun</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Keterangan Reject</th>
            <th>Aksi</th>
        </tr>
    </thead>
<tbody>

@forelse($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->pegawai->nama }}</td>
    <td>
        {{
            [
                'eksternal' => 'Eksternal Instansi',
                'internal'  => 'Internal Instansi',
            ][$d->jenis] ?? $d->jenis
        }}
    </td>
    <td>{{ $d->tingkatan }}</td>
    <td>{{ $d->nama_penghargaan }}</td>
    <td>{{ $d->pemberi }}</td>
    <td>{{ $d->tahun }}</td>
    <td>
        @if($d->bukti)
        <a target="_blank" href="{{asset('storage/'.$d->bukti)}}" class="btn btn-secondary btn-sm">
            Lihat
        </a>
        @endif
    </td>
    <td>
        @switch($d->row_status)
            @case('APPROVED')
                <span class="badge bg-success">Approved</span>
                @break

            @case('REJECTED')
                <span class="badge bg-danger">Rejected</span>
                @break

            @default
                <span class="badge bg-warning text-dark">Pending</span>

        @endswitch
    </td>

    <td>{{ $d->reject_reason }}</td>

    <td>
        @if(auth()->user()->role == 'ADMIN')
            @if($d->row_status == 'PENDING')
                <form action="{{ route('penghargaan.approve',$d->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin approve data?')">Approve</button>
                </form>

                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $d->id }}">Reject</button>
            @endif

            <a href="{{ route('penghargaan.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('penghargaan.destroy',$d->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
            </form>

        @else
            @if($d->row_status != 'APPROVED')
                <a href="{{ route('penghargaan.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>
            @endif
        @endif
    </td>
</tr>

<div class="modal fade" id="rejectModal{{ $d->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('penghargaan.reject',$d->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Alasan Reject</label>
                    <textarea name="reject_reason" class="form-control" rows="4" required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>


@empty

<tr>
    <td colspan="11" class="text-center">
        Tidak ada data.
    </td>
</tr>

@endforelse

</tbody>

</table>

{{ $data->links() }}

@endsection
