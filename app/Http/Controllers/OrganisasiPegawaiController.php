<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\OrganisasiPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisasiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OrganisasiPegawai::with('pegawai')
            ->latest()
            ->paginate(10);


        return view(
            'organisasi.index',
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
            'organisasi.create',
            compact('pegawai')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([

            'pegawai_id'=>'required',

            'nama_organisasi'=>'required',


            'peran'=>'required',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $bukti=null;


        if($request->hasFile('bukti')){

            $bukti=$request->file('bukti')
                ->store(
                    'bukti-organisasi',
                    'public'
                );
        }



        OrganisasiPegawai::create([

            'pegawai_id'=>$request->pegawai_id,

            'nama_organisasi'=>$request->nama_organisasi,


            'peran'=>$request->peran,

            'tahun_mulai'=>$request->tahun_mulai,

            'tahun_selesai'=>$request->tahun_selesai,

            'bukti'=>$bukti

        ]);



        return redirect()
            ->route('organisasi.index')
            ->with(
                'success',
                'Data organisasi berhasil ditambahkan'
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
public function edit(OrganisasiPegawai $organisasi)
    {

        $pegawai = Pegawai::orderBy('nama')
            ->get();


        return view(
            'organisasi.edit',
            compact(
                'organisasi',
                'pegawai'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        OrganisasiPegawai $organisasi
    )
    {


        $request->validate([

            'pegawai_id'=>'required',

            'nama_organisasi'=>'required',

            'peran'=>'required',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $bukti=$organisasi->bukti;



        if($request->hasFile('bukti')){


            if($bukti){

                Storage::disk('public')
                    ->delete($bukti);

            }


            $bukti=$request->file('bukti')
                ->store(
                    'bukti-organisasi',
                    'public'
                );
        }




        $organisasi->update([

            'pegawai_id'=>$request->pegawai_id,

            'nama_organisasi'=>$request->nama_organisasi,

            'jenis_organisasi'=>$request->jenis_organisasi,

            'peran'=>$request->peran,

            'tahun_mulai'=>$request->tahun_mulai,

            'tahun_selesai'=>$request->tahun_selesai,

            'bukti'=>$bukti

        ]);



        return redirect()
            ->route('organisasi.index')
            ->with(
                'success',
                'Data organisasi berhasil diperbarui'
            );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        OrganisasiPegawai $organisasi
    )
    {

        if($organisasi->bukti){

            Storage::disk('public')
                ->delete($organisasi->bukti);
        }


        $organisasi->delete();


        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );

    }
}
