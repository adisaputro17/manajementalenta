<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PenugasanTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Constants\Role;

class PenugasanTimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == Role::ADMIN){
            $data = PenugasanTim::with('pegawai')->latest()->paginate(10);
        }else{
            $data = PenugasanTim::where('pegawai_id', auth()->id())->latest()->paginate(10);
        }
        
        return view('penugasan.index', compact('data'));
    }
    
    public function create()
    {
        if (auth()->user()->role == Role::ADMIN) {
            $pegawai = Pegawai::orderBy('nama')->get();
        } else {
            $pegawai = Pegawai::where('id', auth()->id())->get();
        }
        
        return view('penugasan.create', compact('pegawai'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'lingkup'=>'required',
            'tingkatan'=>'required',
            'tahun'=>'required',
            'bukti'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);
        
        $bukti=null;
        if($request->hasFile('bukti')){
            $bukti=$request->file('bukti')->store(
                'bukti-penugasan',
                'public'
            );
        }
        
        PenugasanTim::create([
            'pegawai_id'=>$request->pegawai_id,
            'lingkup'=>$request->lingkup,
            'tingkatan'=>$request->tingkatan,
            'nilai'=>PenugasanTim::LEVEL[
                $request->tingkatan
            ],
            'nama_tim'=>$request->nama_tim,
            'tahun'=>$request->tahun,
            'bukti'=>$bukti,
            'row_status'=>'APPROVED'
        ]);
        
        return redirect()->route('penugasan.index')->with(
            'success',
            'Penugasan berhasil disimpan'
        );
    }
    
    public function edit(PenugasanTim $penugasan)
    {
        abort_if(
            auth()->user()->role!=Role::ADMIN && $penugasan->pegawai_id!=auth()->id(),
            403
        );

        if (auth()->user()->role == Role::ADMIN) {
            $pegawai = Pegawai::orderBy('nama')->get();
        } else {
            $pegawai = Pegawai::where('id', auth()->id())->get();
        }
        
        return view('penugasan.edit', compact('penugasan','pegawai'));
    }
    
    public function update(Request $request, PenugasanTim $penugasan)
    {
        $request->validate([
            'pegawai_id'=>'required',
            'lingkup'=>'required',
            'tingkatan'=>'required',
            'tahun'=>'required'
        ]);
        
        $bukti=$penugasan->bukti;
        if($request->hasFile('bukti')){
            if($bukti){
                Storage::delete($bukti);
            }
            
            $bukti=$request->file('bukti')->store(
                'bukti-penugasan',
                'public'
            );
        }
        
        $penugasan->update([
            'pegawai_id'=>$request->pegawai_id,
            'lingkup'=>$request->lingkup,
            'tingkatan'=>$request->tingkatan,
            'nilai'=>PenugasanTim::LEVEL[
                $request->tingkatan
            ],
            'nama_tim'=>$request->nama_tim,
            'tahun'=>$request->tahun,
            'bukti'=>$bukti,
            'row_status'=>'APPROVED',
            'approved_by'=>null,
            'approved_at'=>null,
            'reject_reason'=>null
        ]);
        
        return redirect()->route('penugasan.index')->with(
            'success',
            'Data diperbarui'
        );
    }
    
    public function destroy(PenugasanTim $penugasan)
    {
        if($penugasan->bukti){
            Storage::delete($penugasan->bukti);
        }
        
        $penugasan->delete();
        
        return redirect()->route('penugasan.index')->with(
            'success',
            'Data dihapus'
        );
    }

    public function approve(PenugasanTim $penugasan)
    {
        $penugasan->update([
            'row_status'=>'APPROVED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>null
        ]);
        
        return back();
    }

    public function reject(Request $request, PenugasanTim $penugasan)
    {
        $request->validate([
            'reject_reason'=>'required'
        ]);
        
        $penugasan->update([
            'row_status'=>'REJECTED',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'reject_reason'=>$request->reject_reason
        ]);
        
        return back();
    }
}
