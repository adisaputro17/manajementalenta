@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Predikat Kinerja</h3>
    
    @if(Auth::user()->role == "ADMIN")
        <a href="{{ route('predikat.create') }}" class="btn btn-primary">
            Tambah
        </a>
    @endif
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Pegawai</th>
            <th>Tahun</th>
            <th>Predikat</th>
            
            @if(Auth::user()->role == "ADMIN")
                <th>Status</th>
                <th>Keterangan Reject</th>
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
<tbody>

@forelse($data as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->pegawai->nama }}</td>
    <td>{{ $d->tahun }}</td>
    <td>{{ $d->keterangan }}</td>

    @if(Auth::user()->role == "ADMIN")
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
                <form action="{{ route('predikat.approve',$d->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin approve data?')">Approve</button>
                </form>

                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $d->id }}">Reject</button>
            @endif

            <a href="{{ route('predikat.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('predikat.destroy',$d->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
            </form>

        @else
            @if($d->row_status != 'APPROVED')
                <a href="{{ route('predikat.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>
            @endif
        @endif
    </td>
    @endif
</tr>

<div class="modal fade" id="rejectModal{{ $d->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('predikat.reject',$d->id) }}" method="POST">
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
    <td colspan="7" class="text-center">
        Tidak ada data.
    </td>
</tr>

@endforelse

</tbody>

</table>

{{ $data->links() }}

@endsection
