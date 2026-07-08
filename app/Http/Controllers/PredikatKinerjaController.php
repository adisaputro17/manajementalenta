<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PredikatKinerja;
use Illuminate\Http\Request;
use App\Constants\Role;

class PredikatKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == Role::ADMIN){
            $data = PredikatKinerja::with('pegawai')->latest()->paginate(10);
        }else{
            $data = PredikatKinerja::where('pegawai_id', auth()->id())->latest()->paginate(10);
        }
        
        return view('predikat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == Role::ADMIN) {
            $pegawai = Pegawai::orderBy('nama')->get();
        } else {
            $pegawai = Pegawai::where('id', auth()->id())->get();
        }
        
        return view('predikat.create', compact('pegawai'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'tahun'=>'required',
            'nilai'=>'required|in:100,80,60,40,20'
        ]);
        
        PredikatKinerja::create([
            'pegawai_id'=>$request->pegawai_id,
            'tahun'=>$request->tahun,
            'nilai'=>$request->nilai,
            'keterangan'=>$this->getKeterangan($request->nilai),
            'row_status'=>'PENDING'
        ]);
        
        return redirect()->route('predikat.index')->with(
            'success',
            'Predikat berhasil disimpan'
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
    public function edit(PredikatKinerja $predikat)
    {
        abort_if(
            auth()->user()->role!=Role::ADMIN && $predikat->pegawai_id!=auth()->id(),
            403
        );

        if (auth()->user()->role == Role::ADMIN) {
            $pegawai = Pegawai::orderBy('nama')->get();
        } else {
            $pegawai = Pegawai::where('id', auth()->id())->get();
        }
        
        return view('predikat.edit',compact('predikat','pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,PredikatKinerja $predikat)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'tahun'=>'required',
            'nilai'=>'required|in:100,80,60,40,20'
        ]);
        
        $predikat->update([
            'pegawai_id'=>$request->pegawai_id,
            'tahun'=>$request->tahun,
            'nilai'=>$request->nilai,
            'keterangan'=>$this->getKeterangan($request->nilai),
            'row_status'=>'PENDING',
            'approved_by'=>null,
            'approved_at'=>null,
            'reject_reason'=>null
        ]);
        
        return redirect()->route('predikat.index')->with(
            'success',
            'Data diperbarui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PredikatKinerja $predikat)
    {
        $predikat->delete();
        
        return redirect()->route('predikat.index')->with(
            'success',
            'Data dihapus'
        );
    }

    public function approve(PredikatKinerja $predikat)
    {
        $predikat->update([
            'row_status'=>'APPROVED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>null
        ]);
        
        return back();
    }

    public function reject(Request $request, PredikatKinerja $predikat)
    {
        $request->validate([
            'reject_reason'=>'required'
        ]);
        
        $predikat->update([
            'row_status'=>'REJECTED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>$request->reject_reason
        ]);
        
        return back();
    }

    private function getKeterangan(int $nilai): string
    {
        return match ($nilai) {
            100 => 'Sangat Baik',
            80  => 'Baik',
            60  => 'Butuh Perbaikan',
            40  => 'Kurang',
            20  => 'Sangat Kurang',
        };
    }
}