<?php

namespace App\Http\Controllers;

use App\Models\TalentWeight;
use Illuminate\Http\Request;

class TalentWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TalentWeight::orderBy('kategori')
            ->get();


        return view(
            'talent_weight.index',
            compact('data')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'talent_weight.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'kategori'=>'required',

            'indikator'=>'required',

            'persentase'=>'required|numeric|min:0|max:100'

        ]);



        TalentWeight::create(
            $request->all()
        );


        return redirect()
            ->route('talent-weight.index')
            ->with(
                'success',
                'Setting bobot berhasil disimpan'
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
    public function edit(
        TalentWeight $talentWeight
    )
    {

        return view(
            'talent_weight.edit',
            compact('talentWeight')
        );

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(
        Request $request,
        TalentWeight $talentWeight
    )
    {

        $request->validate([

            'kategori'=>'required',

            'indikator'=>'required',

            'persentase'=>'required|numeric|min:0|max:100'

        ]);



        $talentWeight->update(
            $request->all()
        );


        return redirect()
            ->route('talent-weight.index')
            ->with(
                'success',
                'Setting berhasil diperbarui'
            );

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        TalentWeight $talentWeight
    )
    {

        $talentWeight->delete();


        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );

    }
}
