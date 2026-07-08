<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Constants\Role;

class PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == Role::ADMIN){
            $data = Penghargaan::with('pegawai')->latest()->paginate(10);
        }else{
            $data = Penghargaan::where('pegawai_id', auth()->id())->latest()->paginate(10);
        }
        
        return view('penghargaan.index', compact('data'));
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
        
        return view('penghargaan.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'jenis'=>'required',
            'tingkatan'=>'required',
            'nama_penghargaan'=>'required',
            'tahun'=>'required',
            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);
        
        $bukti=null;
        if($request->hasFile('bukti')){
            $bukti=$request->file('bukti')->store(
                'bukti-penghargaan',
                'public'
            );
        }
        
        Penghargaan::create([
            'pegawai_id'=>$request->pegawai_id,
            'jenis'=>$request->jenis,
            'tingkatan'=>$request->tingkatan,
            'nilai'=>Penghargaan::LEVEL[
                $request->tingkatan
            ],
            'nama_penghargaan'=>$request->nama_penghargaan,
            'pemberi'=>$request->pemberi,
            'tahun'=>$request->tahun,
            'bukti'=>$bukti,
            'row_status'=>'PENDING'
        ]);
        
        return redirect()->route('penghargaan.index')->with(
            'success',
            'Penghargaan berhasil disimpan'
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
    public function edit(Penghargaan $penghargaan)
    {
        abort_if(
            auth()->user()->role!=Role::ADMIN && $penghargaan->pegawai_id!=auth()->id(),
            403
        );

        if (auth()->user()->role == Role::ADMIN) {
            $pegawai = Pegawai::orderBy('nama')->get();
        } else {
            $pegawai = Pegawai::where('id', auth()->id())->get();
        }
        
        return view('penghargaan.edit', compact('penghargaan','pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Penghargaan $penghargaan)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'jenis'=>'required',
            'tingkatan'=>'required',
            'nama_penghargaan'=>'required',
            'tahun'=>'required'
        ]);

        $bukti=$penghargaan->bukti;
        if($request->hasFile('bukti')){
            if($bukti){
                Storage::delete($bukti);
            }
            
            $bukti=$request->file('bukti')->store(
                'bukti-penghargaan',
                'public'
            );
        }
        
        $penghargaan->update([
            'pegawai_id'=>$request->pegawai_id,
            'jenis'=>$request->jenis,
            'tingkatan'=>$request->tingkatan,
            'nilai'=>Penghargaan::LEVEL[
                $request->tingkatan
            ],
            'nama_penghargaan'=>$request->nama_penghargaan,
            'pemberi'=>$request->pemberi,
            'tahun'=>$request->tahun,
            'bukti'=>$bukti,
            'row_status'=>'PENDING',
            'approved_by'=>null,
            'approved_at'=>null,
            'reject_reason'=>null
        ]);
        
        return redirect()->route('penghargaan.index')->with(
            'success',
            'Data diperbarui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghargaan $penghargaan)
    {
        if($penghargaan->bukti){
            Storage::delete($penghargaan->bukti);
        }
        
        $penghargaan->delete();
        
        return redirect()->route('penghargaan.index')->with(
            'success',
            'Data dihapus'
        );
    }

    public function approve(Penghargaan $penghargaan)
    {
        $penghargaan->update([
            'row_status'=>'APPROVED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>null
        ]);
        
        return back();
    }

    public function reject(Request $request, Penghargaan $penghargaan)
    {
        $request->validate([
            'reject_reason'=>'required'
        ]);
        
        $penghargaan->update([
            'row_status'=>'REJECTED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>$request->reject_reason
        ]);
        
        return back();
    }
}
