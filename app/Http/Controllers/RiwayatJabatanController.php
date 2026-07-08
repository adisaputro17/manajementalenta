<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RiwayatJabatan::with('pegawai')
            ->orderByDesc('mulai_jabatan')
            ->paginate(10);


        return view(
            'riwayat_jabatan.index',
            compact('data')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::orderBy('nama')
            ->get();


        return view(
            'riwayat_jabatan.create',
            compact('pegawai')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'pegawai_id'=>'required',

            'nama_jabatan'=>'required',

            'jenis_jabatan'=>'required',

            'mulai_jabatan'=>'required|date',

            'akhir_jabatan'=>'nullable|date',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);


        $bukti = null;


        if($request->hasFile('bukti')){

            $bukti = $request
                ->file('bukti')
                ->store(
                    'bukti-riwayat-jabatan',
                    'public'
                );

        }



        RiwayatJabatan::create([

            'pegawai_id'=>$request->pegawai_id,

            'nama_jabatan'=>$request->nama_jabatan,

            'jenis_jabatan'=>$request->jenis_jabatan,

            'mulai_jabatan'=>$request->mulai_jabatan,

            'akhir_jabatan'=>$request->akhir_jabatan,

            'bukti'=>$bukti

        ]);


        return redirect()
            ->route('riwayat-jabatan.index')
            ->with(
                'success',
                'Riwayat jabatan berhasil ditambahkan'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatJabatan $riwayatJabatan)
    {

        $pegawai = Pegawai::orderBy('nama')
            ->get();


        return view(
            'riwayat_jabatan.edit',
            compact(
                'riwayatJabatan',
                'pegawai'
            )
        );

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(
        Request $request,
        RiwayatJabatan $riwayatJabatan
    )
    {

        $request->validate([

            'pegawai_id'=>'required',

            'nama_jabatan'=>'required',

            'jenis_jabatan'=>'required',

            'mulai_jabatan'=>'required|date',

            'akhir_jabatan'=>'nullable|date',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $bukti = $riwayatJabatan->bukti;



        if($request->hasFile('bukti')){


            if($bukti){
                Storage::disk('public')
                    ->delete($bukti);
            }


            $bukti = $request
                ->file('bukti')
                ->store(
                    'bukti-riwayat-jabatan',
                    'public'
                );
        }



        $riwayatJabatan->update([

            'pegawai_id'=>$request->pegawai_id,

            'nama_jabatan'=>$request->nama_jabatan,

            'jenis_jabatan'=>$request->jenis_jabatan,

            'mulai_jabatan'=>$request->mulai_jabatan,

            'akhir_jabatan'=>$request->akhir_jabatan,

            'bukti'=>$bukti

        ]);



        return redirect()
            ->route('riwayat-jabatan.index')
            ->with(
                'success',
                'Riwayat jabatan berhasil diperbarui'
            );

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(RiwayatJabatan $riwayatJabatan)
    {


        if($riwayatJabatan->bukti){

            Storage::disk('public')
                ->delete($riwayatJabatan->bukti);

        }


        $riwayatJabatan->delete();


        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );

    }
}
