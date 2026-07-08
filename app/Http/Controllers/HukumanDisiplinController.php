<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\HukumanDisiplin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HukumanDisiplinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HukumanDisiplin::with('pegawai')
            ->latest()
            ->paginate(10);


        return view(
            'hukuman.index',
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
            'hukuman.create',
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

            'jenis_hukuman'=>'required',

            'tanggal_mulai'=>'required|date',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $bukti=null;



        if($request->hasFile('bukti')){

            $bukti=$request->file('bukti')
                ->store(
                    'bukti-hukuman-disiplin',
                    'public'
                );

        }



        HukumanDisiplin::create([

            'pegawai_id'=>$request->pegawai_id,

            'jenis_hukuman'=>$request->jenis_hukuman,

            'tanggal_mulai'=>$request->tanggal_mulai,

            'tanggal_selesai'=>$request->tanggal_selesai,

            'sedang_menjalani'=>$request->sedang_menjalani ?? false,

            'nomor_sk'=>$request->nomor_sk,

            'bukti'=>$bukti

        ]);



        return redirect()
            ->route('hukuman.index')
            ->with(
                'success',
                'Data hukuman disiplin berhasil disimpan'
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
    public function edit(HukumanDisiplin $hukuman)
    {

        $pegawai = Pegawai::orderBy('nama')
            ->get();


        return view(
            'hukuman.edit',
            compact(
                'hukuman',
                'pegawai'
            )
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        HukumanDisiplin $hukuman
    )
    {

        $request->validate([

            'pegawai_id'=>'required',

            'jenis_hukuman'=>'required',

            'tanggal_mulai'=>'required|date',

            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'

        ]);



        $bukti=$hukuman->bukti;



        if($request->hasFile('bukti')){


            if($bukti){

                Storage::disk('public')
                    ->delete($bukti);

            }


            $bukti=$request->file('bukti')
                ->store(
                    'bukti-hukuman-disiplin',
                    'public'
                );

        }



        $hukuman->update([

            'pegawai_id'=>$request->pegawai_id,

            'jenis_hukuman'=>$request->jenis_hukuman,

            'tanggal_mulai'=>$request->tanggal_mulai,

            'tanggal_selesai'=>$request->tanggal_selesai,

            'sedang_menjalani'=>$request->sedang_menjalani ?? false,

            'nomor_sk'=>$request->nomor_sk,

            'bukti'=>$bukti

        ]);



        return redirect()
            ->route('hukuman.index')
            ->with(
                'success',
                'Data berhasil diperbarui'
            );

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        HukumanDisiplin $hukuman
    )
    {

        if($hukuman->bukti){

            Storage::disk('public')
                ->delete($hukuman->bukti);

        }


        $hukuman->delete();


        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );

    }
}
