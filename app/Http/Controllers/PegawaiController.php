<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::latest()->paginate(10);
        
        return view('pegawai.index',compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'nip'=>'required|unique:pegawais,nip',
            'nama'=>'required',
            'password' => 'required|min:6',
            'role' => 'required|in:ADMIN,PEGAWAI',
            'jabatan'=>'nullable',
            'unit_kerja'=>'nullable',
            'golongan'=>'nullable',

        ]);
        
        $validated['password'] = Hash::make($validated['password']);

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success','Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
         return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nip'         => 'required|unique:pegawais,nip,' . $pegawai->id,
            'nama'        => 'required',
            'jabatan'     => 'nullable',
            'unit_kerja'  => 'nullable',
            'golongan'    => 'nullable',
            'role'        => 'required|in:ADMIN,PEGAWAI',
            'password'    => 'nullable|min:6',
        ]);
        
        // Jika password diisi, hash password baru
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jangan update password jika kosong
            unset($validated['password']);
        }
        
        $pegawai->update($validated);
        
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
