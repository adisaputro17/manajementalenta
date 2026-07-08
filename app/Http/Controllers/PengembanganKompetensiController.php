<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengembanganKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PengembanganKompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PengembanganKompetensi::with('pegawai')
            ->latest()
            ->paginate(10);

        return view('kompetensi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        return view('kompetensi.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'jp' => 'required|integer',
            'bukti' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $bukti = null;

        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti')
                ->store('bukti-kompetensi', 'public');
        }

        PengembanganKompetensi::create([
            'pegawai_id' => $request->pegawai_id,
            'jp' => $request->jp,
            'kegiatan' => $request->kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'tahun' => $request->tahun,
            'bukti' => $bukti
        ]);

        return redirect()->route('kompetensi.index')
            ->with('success', 'Data berhasil ditambahkan');
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
    public function edit(PengembanganKompetensi $kompetensi)
    {
        $pegawai = Pegawai::all();
        return view('kompetensi.edit', compact('kompetensi', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengembanganKompetensi $kompetensi)
    {
        $bukti = $kompetensi->bukti;

        if ($request->hasFile('bukti')) {
            if ($bukti) Storage::delete($bukti);

            $bukti = $request->file('bukti')
                ->store('bukti-kompetensi', 'public');
        }

        $kompetensi->update([
            'pegawai_id' => $request->pegawai_id,
            'jp' => $request->jp,
            'nilai' => $this->hitungNilai($request->jp),
            'kegiatan' => $request->kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'tahun' => $request->tahun,
            'bukti' => $bukti
        ]);

        return redirect()->route('kompetensi.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengembanganKompetensi $kompetensi)
    {
        if ($kompetensi->bukti) {
            Storage::delete($kompetensi->bukti);
        }

        $kompetensi->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
