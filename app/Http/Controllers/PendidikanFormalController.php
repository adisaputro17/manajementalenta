<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PendidikanFormal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PendidikanFormalController extends Controller
{
public function index()
{

$data = PendidikanFormal::with('pegawai')
    ->latest()
    ->paginate(10);


return view(
    'pendidikan.index',
    compact('data')
);

}





public function create()
{

$pegawai = Pegawai::orderBy('nama')
    ->get();


return view(
    'pendidikan.create',
    compact('pegawai')
);

}





public function store(Request $request)
{
    

$request->validate([

    'pegawai_id'=>'required',
    'tingkatan'=>'required',
    'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

]);



$bukti=null;


if($request->hasFile('bukti'))
{

// $bukti=$request->file('bukti')->store('bukti-pendidikan');
$bukti = $request->file('bukti')->store('bukti-pendidikan', 'public');

}



PendidikanFormal::create([

'pegawai_id'=>$request->pegawai_id,

'tingkatan'=>$request->tingkatan,

'nilai'=>PendidikanFormal::LEVEL[
$request->tingkatan
],

'jurusan'=>$request->jurusan,

'universitas_sekolah'=>$request->universitas_sekolah,

'tahun_lulus'=>$request->tahun_lulus,

'bukti'=>$bukti

]);



return redirect()
->route('pendidikan.index')
->with(
'success',
'Data pendidikan berhasil disimpan'
);

}







public function edit(
PendidikanFormal $pendidikan
)
{

$pegawai = Pegawai::orderBy('nama')
->get();


return view(
'pendidikan.edit',
compact(
'pendidikan',
'pegawai'
)
);

}







public function update(
Request $request,
PendidikanFormal $pendidikan
)
{


$request->validate([

    'pegawai_id'=>'required',
    'tingkatan'=>'required'

]);



$bukti=$pendidikan->bukti;



if($request->hasFile('bukti'))
{


if($bukti)
{
Storage::delete($bukti);
}


$bukti=$request
->file('bukti')
->store(
'bukti-pendidikan'
);

}




$pendidikan->update([


'pegawai_id'=>$request->pegawai_id,

'tingkatan'=>$request->tingkatan,

'nilai'=>PendidikanFormal::LEVEL[
$request->tingkatan
],

'jurusan'=>$request->jurusan,

'universitas_sekolah'=>$request->universitas_sekolah,

'tahun_lulus'=>$request->tahun_lulus,

'bukti'=>$bukti


]);



return redirect()
->route('pendidikan.index')
->with(
'success',
'Data berhasil diperbarui'
);


}







public function destroy(
PendidikanFormal $pendidikan
)
{

if($pendidikan->bukti)
{
Storage::delete(
$pendidikan->bukti
);
}


$pendidikan->delete();


return redirect()
->route('pendidikan.index')
->with(
'success',
'Data berhasil dihapus'
);

}
}
